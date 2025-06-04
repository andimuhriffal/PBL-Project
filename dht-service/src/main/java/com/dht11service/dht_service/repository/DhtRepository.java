package com.dht11service.dht_service.repository;

import com.dht11service.dht_service.model.DhtData;
import org.springframework.data.jpa.repository.JpaRepository;

public interface DhtRepository extends JpaRepository<DhtData, Long> {
    DhtData findTopByOrderByTimestampDesc(); // Menyesuaikan dengan field 'timestamp' di model
}
