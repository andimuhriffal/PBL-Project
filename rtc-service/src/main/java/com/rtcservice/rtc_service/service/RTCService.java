package com.rtcservice.rtc_service.service;

import com.rtcservice.rtc_service.model.RTC;
import com.rtcservice.rtc_service.repository.RTCRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class RTCService {

    private final RTCRepository rtcRepository;

    @Autowired
    public RTCService(RTCRepository rtcRepository) {
        this.rtcRepository = rtcRepository;
    }

    // Ambil semua data RTC
    public List<RTC> getAllWaktu() {
        return rtcRepository.findAll();
    }

    // Ambil data RTC berdasarkan id
    public Optional<RTC> getWaktuById(Long id) {
        return rtcRepository.findById(id);
    }

    // Simpan data RTC baru
    public RTC saveWaktu(RTC rtc) {
        return rtcRepository.save(rtc);
    }

    // Hapus data RTC berdasarkan id
    public void deleteWaktu(Long id) {
        rtcRepository.deleteById(id);
    }

    // Update data RTC berdasarkan id, jika tidak ada maka simpan sebagai baru
    public RTC updateWaktu(Long id, RTC newRtcData) {
        return rtcRepository.findById(id)
                .map(rtc -> {
                    rtc.setWaktuPagi(newRtcData.getWaktuPagi());
                    rtc.setWaktuSore(newRtcData.getWaktuSore());
                    rtc.setStatusPakan(newRtcData.getStatusPakan()); // Tambahan
                    return rtcRepository.save(rtc);
                })
                .orElseGet(() -> {
                    newRtcData.setId(id);
                    return rtcRepository.save(newRtcData);
                });
    }
}
