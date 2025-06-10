package com.rtcservice.rtc_service.service;

import com.rtcservice.rtc_service.model.RTC;
import com.rtcservice.rtc_service.repository.RTCRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Service;

import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.Optional;

@Service
public class RTCService {

    private final RTCRepository rtcRepository;
    private final TelegramService telegramService;

    @Autowired
    public RTCService(RTCRepository rtcRepository, TelegramService telegramService) {
        this.rtcRepository = rtcRepository;
        this.telegramService = telegramService;
    }

    public List<RTC> getAllWaktu() {
        return rtcRepository.findAll();
    }

    public Optional<RTC> getWaktuById(Long id) {
        return rtcRepository.findById(id);
    }

    public RTC saveWaktu(RTC rtc) {
        RTC savedRtc = rtcRepository.save(rtc);

        if ("Waktu pakan telah diset".equalsIgnoreCase(rtc.getStatusPakan())) {
            telegramService.sendMessage("✅ Jadwal pakan berhasil diset!\n" +
                    "🕗 Pagi: " + rtc.getWaktuPagi() + "\n" +
                    "🌇 Sore: " + rtc.getWaktuSore());
        }

        return savedRtc;
    }

    public void deleteWaktu(Long id) {
        rtcRepository.deleteById(id);
    }

    public RTC updateWaktu(Long id, RTC newRtcData) {
        return rtcRepository.findById(id)
                .map(rtc -> {
                    rtc.setWaktuPagi(newRtcData.getWaktuPagi());
                    rtc.setWaktuSore(newRtcData.getWaktuSore());
                    rtc.setStatusPakan(newRtcData.getStatusPakan());
                    RTC updatedRtc = rtcRepository.save(rtc);

                    if ("Waktu pakan telah diset".equalsIgnoreCase(rtc.getStatusPakan())) {
                        telegramService.sendMessage("✅ Jadwal pakan berhasil diperbarui!\n" +
                                "🕗 Pagi: " + rtc.getWaktuPagi() + "\n" +
                                "🌇 Sore: " + rtc.getWaktuSore());
                    }

                    return updatedRtc;
                })
                .orElseGet(() -> {
                    newRtcData.setId(id);
                    RTC savedRtc = rtcRepository.save(newRtcData);

                    if ("Waktu pakan telah diset".equalsIgnoreCase(savedRtc.getStatusPakan())) {
                        telegramService.sendMessage("✅ Jadwal pakan berhasil disimpan!\n" +
                                "🕗 Pagi: " + savedRtc.getWaktuPagi() + "\n" +
                                "🌇 Sore: " + savedRtc.getWaktuSore());
                    }

                    return savedRtc;
                });
    }

    // Scheduler yang berjalan setiap awal menit
    @Scheduled(cron = "0 * * * * *") // setiap awal menit
    public void checkAndNotifyFeedingTime() {
        List<RTC> rtcList = rtcRepository.findAll();
        LocalTime now = LocalTime.now().withSecond(0).withNano(0); // bulatkan ke menit
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("HH:mm");

        for (RTC rtc : rtcList) {
            String status = rtc.getStatusPakan();
            Long id = rtc.getId();
            System.out.println("🔍 Cek RTC ID " + id + " | status: " + status);

            if (status != null && status.equalsIgnoreCase("Waktu pakan telah diset")) {
                try {
                    String waktuPagi = rtc.getWaktuPagi(); // format "HH:mm"
                    String waktuSore = rtc.getWaktuSore();

                    LocalTime pagiTime = LocalTime.parse(waktuPagi, formatter);
                    LocalTime soreTime = LocalTime.parse(waktuSore, formatter);

                    if (now.equals(pagiTime)) {
                        telegramService.sendMessage("🔔 Jadwal Pakan Pagi: Waktunya memberi makan ayam!");
                    } else if (now.equals(soreTime)) {
                        telegramService.sendMessage("🔔 Jadwal Pakan Sore: Waktunya memberi makan ayam!");
                    }
                } catch (Exception e) {
                    System.err.println("❌ Gagal memproses RTC ID " + id + ": " + e.getMessage());
                }
            }
        }
    }
}
