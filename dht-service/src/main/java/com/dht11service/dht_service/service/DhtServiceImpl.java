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

    private static final int MAX_INVALID_COUNT = 5; // threshold invalid berturut-turut
    private int invalidCount = 0;

    private DhtData lastData = null;

    @Override
    public DhtData simpanData(DhtRequest request) {
        String statusSensor = "AKTIF";

        // Cek apakah data suhu atau kelembapan invalid (misal 0)
        boolean dataInvalid = (request.getSuhu() == 0 || request.getKelembapan() == 0);

        if (dataInvalid) {
            invalidCount++;
        } else {
            invalidCount = 0; // reset jika data valid
        }

        if (invalidCount >= MAX_INVALID_COUNT) {
            statusSensor = "MATI";
        } else if (lastData != null) {
            if (dataInvalid || isDataDrasticallyDifferent(lastData, request)) {
                statusSensor = "GANGGUAN";
            }
        }

        // Simpan data ke database (meskipun sensor mati)
        DhtData data = new DhtData();
        data.setSuhu(request.getSuhu());
        data.setKelembapan(request.getKelembapan());
        data.setLampuStatus(request.isLampuStatus());
        data.setKipasStatus(request.isKipasStatus());
        data.setStatusSensor(statusSensor);
        data.setTimestamp(LocalDateTime.now());

        lastData = data;

        return dhtRepository.save(data);
    }

    private boolean isDataDrasticallyDifferent(DhtData lastData, DhtRequest current) {
        int deltaSuhu = Math.abs(lastData.getSuhu() - current.getSuhu());
        int deltaKelembapan = Math.abs(lastData.getKelembapan() - current.getKelembapan());

        return deltaSuhu > 10 || deltaKelembapan > 20;
    }

    @Override
    public DhtData ambilDataTerbaru() {
        return dhtRepository.findTopByOrderByTimestampDesc();
    }
}
