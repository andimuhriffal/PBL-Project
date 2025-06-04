package com.rtcservice.rtc_service.model;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class RTC {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String waktuPagi;
    private String waktuSore;
    private String statusPakan; // Tambahan statusPakan

    // Constructor kosong (default)
    public RTC() {
    }

    // Constructor lengkap
    public RTC(String waktuPagi, String waktuSore, String statusPakan) {
        this.waktuPagi = waktuPagi;
        this.waktuSore = waktuSore;
        this.statusPakan = statusPakan;
    }

    // Getter dan Setter

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
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
}
