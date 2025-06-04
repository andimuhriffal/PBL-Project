package com.dht11service.dht_service.dto;

public class DhtRequest {

    private int suhu;
    private int kelembapan;
    private boolean lampuStatus;
    private boolean kipasStatus;
    private String statusSensor; // ✅ Tambahkan ini

    // Getter dan Setter
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

    public String getStatusSensor() {
        return statusSensor;
    }

    public void setStatusSensor(String statusSensor) {
        this.statusSensor = statusSensor;
    }
}
