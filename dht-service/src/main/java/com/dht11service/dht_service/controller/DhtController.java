package com.dht11service.dht_service.controller;

import com.dht11service.dht_service.dto.DhtRequest;
import com.dht11service.dht_service.model.DhtData;
import com.dht11service.dht_service.service.DhtService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/dht11")
@CrossOrigin
public class DhtController {

    @Autowired
    private DhtService dhtService;

    // Endpoint POST: menerima data dari mikrokontroler
    @PostMapping
    public ResponseEntity<DhtData> kirimData(@RequestBody DhtRequest request) {
        DhtData savedData = dhtService.simpanData(request);
        return ResponseEntity.ok(savedData);
    }

    // Endpoint GET: ambil data DHT terbaru
    @GetMapping("/latest")
    public ResponseEntity<?> ambilDataTerbaru() {
        DhtData latest = dhtService.ambilDataTerbaru();
        if (latest == null) {
            return ResponseEntity.notFound().build();
        }
        return ResponseEntity.ok(latest);
    }
}
