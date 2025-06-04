package com.rtcservice.rtc_service.repository;

import com.rtcservice.rtc_service.model.RTC;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface RTCRepository extends JpaRepository<RTC, Long> {
}
