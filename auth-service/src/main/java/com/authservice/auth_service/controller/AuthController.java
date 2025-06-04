package com.authservice.auth_service.controller;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.authservice.auth_service.dto.LoginRequest;
import com.authservice.auth_service.dto.RegisterRequest;
import com.authservice.auth_service.service.AuthService;

@RestController
@RequestMapping("/api/auth")
@RequiredArgsConstructor
public class AuthController {

    private final AuthService authService;

    @PostMapping("/register")
    public ResponseEntity<String> register(@RequestBody RegisterRequest request) {
        String result = authService.register(request);
        return ResponseEntity.ok(result);
    }

    @PostMapping("/login")
    public ResponseEntity<String> login(@RequestBody LoginRequest request) {
        String result = authService.login(request);
        return ResponseEntity.ok(result);
    }

    @GetMapping("/protected-endpoint")
    public ResponseEntity<String> protectedEndpoint() {
        return ResponseEntity.ok("Ini data dari endpoint yang aman");
    }
}

