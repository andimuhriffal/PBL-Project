package com.rtcservice.rtc_service.dto;

public class RTCRequestDto {
    private String waktuPagi;
    private String waktuSore;
    private String statusPakan;

    // Getter dan Setter
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
}
