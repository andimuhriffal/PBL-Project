package com.ultrasonik.ultrasonik_service.model;

import jakarta.persistence.*;
import org.hibernate.annotations.CreationTimestamp;

import java.time.LocalDateTime;

@Entity
public class UltrasonikData {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private float tinggiAir;
    private float persentaseAir;
    private boolean kranTerbuka;
    private String statusAir;

    @Enumerated(EnumType.STRING)
    @Column(name = "status_sensor_ultrasonik") // Mengubah nama kolom di DB
    private SensorStatus statusSensor;

    @CreationTimestamp
    @Column(updatable = false)
    private LocalDateTime timestamp;

    // --- GETTER & SETTER ---

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

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

    public SensorStatus getStatusSensor() {
        return statusSensor;
    }

    public void setStatusSensor(SensorStatus statusSensor) {
        this.statusSensor = statusSensor;
    }

    public LocalDateTime getTimestamp() {
        return timestamp;
    }

    public void setTimestamp(LocalDateTime timestamp) {
        this.timestamp = timestamp;
    }
}
