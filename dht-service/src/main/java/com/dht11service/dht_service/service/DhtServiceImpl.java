package com.dht11service.dht_service.service;

import com.dht11service.dht_service.dto.DhtRequest;
import com.dht11service.dht_service.model.DhtData;
import com.dht11service.dht_service.repository.DhtRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDateTime;

@Service
public class DhtServiceImpl implements DhtService {

    @Autowired
    private DhtRepository dhtRepository;

    @Autowired
    private TelegramService telegramService;

    private static final int MAX_INVALID_COUNT = 5;
    private int invalidCount = 0;

    private DhtData lastData = null;
    private String lastSensorStatus = "AKTIF"; // Tambahan: menyimpan status sensor sebelumnya

    private static final int MAX_TEMPERATURE = 35;
    private static final int MIN_TEMPERATURE = 15;

    @Override
    public DhtData simpanData(DhtRequest request) {
        String statusSensor = "AKTIF";
        boolean dataInvalid = (request.getSuhu() == 0 || request.getKelembapan() == 0);

        if (dataInvalid) {
            invalidCount++;
        } else {
            invalidCount = 0;
        }

        if (invalidCount >= MAX_INVALID_COUNT) {
            statusSensor = "MATI";

            if (!"MATI".equals(lastSensorStatus)) {
                telegramService.sendMessage(
                    "🚨 *Sensor DHT11 Mati!*\nTidak ada data suhu/kelembapan yang valid selama 5 kali berturut-turut.");
            }

        } else if (lastData != null) {
            if (dataInvalid || isDataDrasticallyDifferent(lastData, request)) {
                statusSensor = "GANGGUAN";

                if (!"GANGGUAN".equals(lastSensorStatus)) {
                    telegramService.sendMessage(String.format(
                        "⚠️ *Gangguan pada Sensor DHT11!*\nData berubah drastis atau tidak valid.\nSuhu: %d°C, Kelembapan: %d%%",
                        request.getSuhu(), request.getKelembapan()));
                }
            }
        }

        // ✅ Sensor kembali normal
        if ("AKTIF".equals(statusSensor) && !"AKTIF".equals(lastSensorStatus)) {
            telegramService.sendMessage(
                "✅ *Sensor DHT11 Kembali Normal!*\nData suhu dan kelembapan telah valid kembali.");
        }

        // 🔥 Suhu terlalu panas
        if (request.getSuhu() > MAX_TEMPERATURE) {
            request.setKipasStatus(true);
            telegramService.sendMessage(String.format(
                "🔥 *Peringatan Suhu Tinggi!*\nSuhu: *%d°C*\n💨 Kipas dinyalakan.",
                request.getSuhu()));
        }

        // ❄️ Suhu terlalu dingin
        if (request.getSuhu() < MIN_TEMPERATURE) {
            request.setLampuStatus(true);
            telegramService.sendMessage(String.format(
                "❄️ *Peringatan Suhu Rendah!*\nSuhu: *%d°C*\n💡 Lampu dinyalakan.",
                request.getSuhu()));
        }

        DhtData data = new DhtData();
        data.setSuhu(request.getSuhu());
        data.setKelembapan(request.getKelembapan());
        data.setLampuStatus(request.isLampuStatus());
        data.setKipasStatus(request.isKipasStatus());
        data.setStatusSensor(statusSensor);
        data.setTimestamp(LocalDateTime.now());

        lastData = data;
        lastSensorStatus = statusSensor; // Perbarui status sensor terakhir
        return dhtRepository.save(data);
    }

    private boolean isDataDrasticallyDifferent(DhtData last, DhtRequest current) {
        int suhuDiff = Math.abs(last.getSuhu() - current.getSuhu());
        int kelembapanDiff = Math.abs(last.getKelembapan() - current.getKelembapan());
        return suhuDiff >= 10 || kelembapanDiff >= 15;
    }

    @Override
    public DhtData ambilDataTerbaru() {
        throw new UnsupportedOperationException("Unimplemented method 'ambilDataTerbaru'");
    }
}
