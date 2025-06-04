package com.ultrasonik.ultrasonik_service.repository;

import com.ultrasonik.ultrasonik_service.model.UltrasonikData;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface UltrasonikRepository extends JpaRepository<UltrasonikData, Long> {
    UltrasonikData findTopByOrderByTimestampDesc();
    // Ambil 5 data terakhir untuk pengecekan kestabilan sensor
    List<UltrasonikData> findTop5ByOrderByTimestampDesc();
}
