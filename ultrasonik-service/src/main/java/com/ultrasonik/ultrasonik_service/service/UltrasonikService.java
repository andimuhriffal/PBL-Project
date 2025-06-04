package com.ultrasonik.ultrasonik_service.service;

import com.ultrasonik.ultrasonik_service.dto.UltrasonikRequest;
import com.ultrasonik.ultrasonik_service.model.UltrasonikData;



public interface UltrasonikService {
    UltrasonikData saveData(UltrasonikRequest request);
    UltrasonikData ambilDataTerbaru();
}
