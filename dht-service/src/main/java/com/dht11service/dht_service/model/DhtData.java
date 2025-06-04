package com.dht11service.dht_service.model;

import jakarta.persistence.*;
import java.time.LocalDateTime;

@Entity
public class DhtData {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private int suhu;
    private int kelembapan;
    private boolean lampuStatus;
    private boolean kipasStatus;

    private LocalDateTime timestamp;

    @Column(nullable = false)
    private String statusSensor; // Menyimpan nilai: "active", "unstable", "inactive"

    // GETTER & SETTER
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public int getSuhu() {
        return suhu;
    }

    public void setSuhu(int suhu) {
        this.suhu = suhu;
    }

    public int getKelembapan() {
        return kelembapan;
    }

    public void setKelembapan(int kelembapan) {
        this.kelembapan = kelembapan;
    }

    public boolean isLampuStatus() {
        return lampuStatus;
    }

    public void setLampuStatus(boolean lampuStatus) {
        this.lampuStatus = lampuStatus;
    }

    public boolean isKipasStatus() {
        return kipasStatus;
    }

    public void setKipasStatus(boolean kipasStatus) {
        this.kipasStatus = kipasStatus;
    }

    public LocalDateTime getTimestamp() {
        return timestamp;
    }

    public void setTimestamp(LocalDateTime timestamp) {
        this.timestamp = timestamp;
    }

    public String getStatusSensor() {
        return statusSensor;
    }

    public void setStatusSensor(String statusSensor) {
        this.statusSensor = statusSensor;
    }
}
