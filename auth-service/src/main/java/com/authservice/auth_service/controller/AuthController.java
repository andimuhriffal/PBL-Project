package com.authservice.auth_service.controller;

import com.authservice.auth_service.dto.LoginRequest;
import com.authservice.auth_service.dto.RegisterRequest;
import com.authservice.auth_service.service.AuthService;
import com.authservice.auth_service.service.JwtService;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
@RequiredArgsConstructor
public class AuthController {

    private final AuthService authService;
    private final JwtService jwtService;

    @PostMapping("/register")
    public ResponseEntity<String> register(@RequestBody RegisterRequest request) {
        String result = authService.register(request);
        return ResponseEntity.ok(result);
    }

    @PostMapping("/login")
    public ResponseEntity<String> login(@RequestBody LoginRequest request) {
        String result = authService.login(request);
        return ResponseEntity.ok(result); // result = JWT token
    }

    @GetMapping("/validate")
    public ResponseEntity<?> validateToken(@RequestHeader("Authorization") String authHeader) {
        if (authHeader == null || !authHeader.startsWith("Bearer ")) {
            return ResponseEntity.status(401).body("Missing or invalid Authorization header");
        }

        String token = authHeader.substring(7); // remove "Bearer "

        if (jwtService.validateToken(token)) {
            // Optional: return user info
            String username = jwtService.extractUsername(token);
            return ResponseEntity.ok().body("{\"username\": \"" + username + "\"}");
        } else {
            return ResponseEntity.status(401).body("Invalid token");
        }
    }

    @GetMapping("/protected-endpoint")
    public ResponseEntity<String> protectedEndpoint() {
        return ResponseEntity.ok("Ini data dari endpoint yang aman");
    }
}
