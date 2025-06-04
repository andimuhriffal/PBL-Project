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

    private static final float BATAS_SELISIH_TINGGI_CM = 4.0f;
    private static final long BATAS_MENIT_MATI = 2;

    @Override
    public UltrasonikData saveData(UltrasonikRequest request) {
        UltrasonikData data = new UltrasonikData();
        data.setTinggiAir(request.getTinggiAir());
        data.setPersentaseAir(request.getPersentaseAir());
        data.setKranTerbuka(request.isKranTerbuka());
        data.setStatusAir(request.getStatusAir());
        data.setStatusSensor(SensorStatus.NORMAL); // default

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

        // Jika data tidak diperbarui > 2 menit
        if (durasi.toMinutes() > BATAS_MENIT_MATI) {
            dataTerbaru.setStatusSensor(SensorStatus.MATI);
            return dataTerbaru;
        }

        List<UltrasonikData> riwayat = repository.findTop5ByOrderByTimestampDesc();

        boolean ada0 = false;
        boolean adaNon0 = false;
        boolean selisihTinggiLebih4 = false;
        boolean semua0Selama2Menit = true;

        float tinggiTerbaru = dataTerbaru.getTinggiAir();

        for (UltrasonikData data : riwayat) {
            float tinggi = data.getTinggiAir();

            if (tinggi == 0f) {
                ada0 = true;
                Duration d = Duration.between(data.getTimestamp(), sekarang);
                if (d.toMinutes() < BATAS_MENIT_MATI) {
                    semua0Selama2Menit = false;
                }
            } else {
                adaNon0 = true;
                semua0Selama2Menit = false;
            }

            float selisih = Math.abs(tinggi - tinggiTerbaru);
            if (selisih > BATAS_SELISIH_TINGGI_CM) {
                selisihTinggiLebih4 = true;
            }
        }

        if (semua0Selama2Menit) {
            dataTerbaru.setStatusSensor(SensorStatus.MATI);
        } else if ((ada0 && adaNon0) || selisihTinggiLebih4 || tinggiTerbaru > 4.0f) {
            dataTerbaru.setStatusSensor(SensorStatus.TIDAK_STABIL);
        } else {
            dataTerbaru.setStatusSensor(SensorStatus.NORMAL);
        }

        return dataTerbaru;
    }
}
