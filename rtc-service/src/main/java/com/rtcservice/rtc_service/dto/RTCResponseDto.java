package com.rtcservice.rtc_service.dto;

public class RTCResponseDto {
    private String waktuPagi;
    private String waktuSore;
    private String statusPakan;
    private String serverTime; // Tambahan

    public RTCResponseDto() {
    }

    public RTCResponseDto(String waktuPagi, String waktuSore, String statusPakan) {
        this.waktuPagi = waktuPagi;
        this.waktuSore = waktuSore;
        this.statusPakan = statusPakan;
    }

    public RTCResponseDto(String waktuPagi, String waktuSore, String statusPakan, String serverTime) {
        this.waktuPagi = waktuPagi;
        this.waktuSore = waktuSore;
        this.statusPakan = statusPakan;
        this.serverTime = serverTime;
    }

    public String getWaktuPagi() {
        return waktuPagi;
    }

    public void setWaktuPagi(String waktuPagi) {
        this.waktuPagi = waktuPagi;
    }

    public String getWaktuSore() {
        return waktuSore;
    }

    public void setWaktuSore(String waktuSore) {
        this.waktuSore = waktuSore;
    }

    public String getStatusPakan() {
        return statusPakan;
    }

    public void setStatusPakan(String statusPakan) {
        this.statusPakan = statusPakan;
    }

    public String getServerTime() {
        return serverTime;
    }

    public void setServerTime(String serverTime) {
        this.serverTime = serverTime;
    }
}
