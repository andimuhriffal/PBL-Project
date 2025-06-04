package com.ultrasonik.ultrasonik_service.controller;

import com.ultrasonik.ultrasonik_service.dto.UltrasonikRequest;
import com.ultrasonik.ultrasonik_service.model.SensorStatus;
import com.ultrasonik.ultrasonik_service.model.UltrasonikData;
import com.ultrasonik.ultrasonik_service.service.UltrasonikService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/ultrasonik")
@CrossOrigin
public class UltrasonikController {

    private final UltrasonikService ultrasonikService;

    @Autowired
    public UltrasonikController(UltrasonikService ultrasonikService) {
        this.ultrasonikService = ultrasonikService;
    }

    @PostMapping
    public ResponseEntity<UltrasonikData> postData(@RequestBody UltrasonikRequest request) {
        UltrasonikData savedData = ultrasonikService.saveData(request);
        return ResponseEntity.ok(savedData);
    }

    @GetMapping("/latest")
    public ResponseEntity<UltrasonikData> ambilDataTerbaru() {
        UltrasonikData latest = ultrasonikService.ambilDataTerbaru();
        return (latest != null)
                ? ResponseEntity.ok(latest)
                : ResponseEntity.notFound().build();
    }

    // ✅ Endpoint untuk mendapatkan status sensor saja
    @GetMapping("/status")
    public ResponseEntity<String> getStatusSensor() {
        UltrasonikData latest = ultrasonikService.ambilDataTerbaru();

        if (latest == null) {
            return ResponseEntity.status(503).body("Sensor tidak mengirim data.");
        }

        SensorStatus status = latest.getStatusSensor();
        return ResponseEntity.ok(status.name());
    }
}
