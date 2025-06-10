package com.ultrasonik.ultrasonik_service.service;

import com.ultrasonik.ultrasonik_service.dto.UltrasonikRequest;
import com.ultrasonik.ultrasonik_service.model.SensorStatus;
import com.ultrasonik.ultrasonik_service.model.UltrasonikData;
import com.ultrasonik.ultrasonik_service.repository.UltrasonikRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.List;

@Service
public class UltrasonikServiceImpl implements UltrasonikService {

    @Autowired
    private UltrasonikRepository repository;

    @Autowired
    private TelegramService telegramService;

    private static final float BATAS_SELISIH_TINGGI_CM = 4.0f;
    private static final long BATAS_MENIT_MATI = 2;

    private SensorStatus lastStatus = SensorStatus.NORMAL;

    @Override
    public UltrasonikData saveData(UltrasonikRequest request) {
        UltrasonikData data = new UltrasonikData();
        data.setTinggiAir(request.getTinggiAir());
        data.setPersentaseAir(request.getPersentaseAir());
        data.setKranTerbuka(request.isKranTerbuka());
        data.setStatusAir(request.getStatusAir());

        // Ambil 5 data terakhir
        List<UltrasonikData> riwayat = repository.findTop5ByOrderByTimestampDesc();

        boolean semua0 = true;
        boolean fluktuasiTinggi = false;

        for (UltrasonikData d : riwayat) {
            float tinggi = d.getTinggiAir();

            if (tinggi != 0f) {
                semua0 = false;
            }

            if (Math.abs(tinggi - request.getTinggiAir()) > BATAS_SELISIH_TINGGI_CM) {
                fluktuasiTinggi = true;
            }
        }

        SensorStatus status;

        if (semua0 && riwayat.size() >= 3) {
            status = SensorStatus.MATI;
            if (lastStatus != SensorStatus.MATI) {
                telegramService.sendMessage("❌ *Sensor Ultrasonik Terindikasi Mati!*\nSemua pembacaan tinggi air = 0.");
            }
        } else if (fluktuasiTinggi) {
            status = SensorStatus.TIDAK_STABIL;
            if (lastStatus != SensorStatus.TIDAK_STABIL) {
                telegramService.sendMessage("⚠️ *Sensor Tidak Stabil!*\nTerjadi fluktuasi tinggi air lebih dari 4 cm.");
            }
        } else {
            status = SensorStatus.NORMAL;
            if (lastStatus != SensorStatus.NORMAL) {
                telegramService.sendMessage("✅ *Sensor Kembali Normal.*");
            }
        }

        lastStatus = status;
        data.setStatusSensor(status);
        if (request.getTinggiAir() > 4.0f) {
            telegramService.sendMessage("🔔 Air Pakan Kepenuhan");
        } else if (request.getTinggiAir() == 0f) {
            telegramService.sendMessage("🚨 Air Pakan Habis");
        }

        return repository.save(data);
    }

    @Override
    public UltrasonikData ambilDataTerbaru() {
        UltrasonikData dataTerbaru = repository.findTopByOrderByTimestampDesc();

        if (dataTerbaru == null) {
            UltrasonikData dummy = new UltrasonikData();
            dummy.setStatusSensor(SensorStatus.MATI);
            return dummy;
        }

        LocalDateTime sekarang = LocalDateTime.now();
        Duration durasi = Duration.between(dataTerbaru.getTimestamp(), sekarang);

        if (durasi.toMinutes() > BATAS_MENIT_MATI) {
            dataTerbaru.setStatusSensor(SensorStatus.MATI);
        }

        return dataTerbaru;
    }
}
