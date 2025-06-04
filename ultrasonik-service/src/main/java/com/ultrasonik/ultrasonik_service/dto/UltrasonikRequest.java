package com.ultrasonik.ultrasonik_service.dto;

public class UltrasonikRequest {
    private float tinggiAir;
    private float persentaseAir;
    private boolean kranTerbuka;
    private String statusAir;

    public float getTinggiAir() {
        return tinggiAir;
    }

    public void setTinggiAir(float tinggiAir) {
        this.tinggiAir = tinggiAir;
    }

    public float getPersentaseAir() {
        return persentaseAir;
    }

    public void setPersentaseAir(float persentaseAir) {
        this.persentaseAir = persentaseAir;
    }

    public boolean isKranTerbuka() {
        return kranTerbuka;
    }

    public void setKranTerbuka(boolean kranTerbuka) {
        this.kranTerbuka = kranTerbuka;
    }

    public String getStatusAir() {
        return statusAir;
    }

    public void setStatusAir(String statusAir) {
        this.statusAir = statusAir;
    }
}
