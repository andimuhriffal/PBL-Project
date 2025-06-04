package com.rtcservice.rtc_service.controller;

import com.rtcservice.rtc_service.dto.RTCRequestDto;
import com.rtcservice.rtc_service.dto.RTCResponseDto;
import com.rtcservice.rtc_service.model.RTC;
import com.rtcservice.rtc_service.service.RTCService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.time.ZoneId;
import java.time.ZonedDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api")
public class RTCController {

    private final RTCService rtcService;

    @Autowired
    public RTCController(RTCService rtcService) {
        this.rtcService = rtcService;
    }

    @GetMapping("/rtc-time")
    public RTCResponseDto getCurrentTime() {
        List<RTC> rtcList = rtcService.getAllWaktu();
        String waktuPagi = "00:00";
        String waktuSore = "00:00";
        String statusPakan = "belum diatur";

        if (!rtcList.isEmpty()) {
            RTC rtc = rtcList.get(rtcList.size() - 1);
            waktuPagi = rtc.getWaktuPagi();
            waktuSore = rtc.getWaktuSore();
            statusPakan = rtc.getStatusPakan();
        }

        ZonedDateTime now = ZonedDateTime.now(ZoneId.of("Asia/Jakarta"));
        String formattedTime = now.format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss"));

        return new RTCResponseDto(waktuPagi, waktuSore, formattedTime, statusPakan);
    }

    @PostMapping("/waktu")
    public RTC saveWaktu(@RequestBody RTCRequestDto rtcRequestDto) {
        RTC rtc = new RTC();
        rtc.setWaktuPagi(rtcRequestDto.getWaktuPagi());
        rtc.setWaktuSore(rtcRequestDto.getWaktuSore());
        rtc.setStatusPakan("Waktu pakan telah diset"); // 👈 status awal

        return rtcService.saveWaktu(rtc);
    }

    @PutMapping("/update-pakan")
    public RTC updateStatusPakan(@RequestParam Long id, @RequestBody Map<String, String> payload) {
        String status = payload.get("statusPakan");

        return rtcService.getWaktuById(id)
                .map(rtc -> {
                    rtc.setStatusPakan(status);
                    return rtcService.saveWaktu(rtc);
                })
                .orElseThrow(() -> new RuntimeException("Data tidak ditemukan"));
    }
}
