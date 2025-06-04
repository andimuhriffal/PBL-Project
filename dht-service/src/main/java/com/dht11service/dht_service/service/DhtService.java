package com.dht11service.dht_service.service;

import com.dht11service.dht_service.dto.DhtRequest;
import com.dht11service.dht_service.model.DhtData;

public interface DhtService {
    DhtData simpanData(DhtRequest request);
    DhtData ambilDataTerbaru();
}
