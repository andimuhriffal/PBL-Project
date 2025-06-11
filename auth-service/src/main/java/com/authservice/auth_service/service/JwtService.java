package com.authservice.auth_service.service;

import com.authservice.auth_service.security.JwtUtil;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class JwtService {

    private final JwtUtil jwtUtil;

    public boolean validateToken(String token) {
        try {
            jwtUtil.extractAllClaims(token); // Akan lempar exception kalau invalid
            return true;
        } catch (Exception e) {
            return false;
        }
    }

    public String extractUsername(String token) {
        return jwtUtil.extractUsername(token);
    }
}
