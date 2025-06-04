package com.authservice.auth_service.service;

import lombok.RequiredArgsConstructor;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import com.authservice.auth_service.dto.LoginRequest;
import com.authservice.auth_service.dto.RegisterRequest;
import com.authservice.auth_service.entity.User;
import com.authservice.auth_service.repository.UserRepository;
import com.authservice.auth_service.security.JwtUtil;

import java.util.Optional;

@Service
@RequiredArgsConstructor
public class AuthService {

    private final UserRepository userRepository;
    private final PasswordEncoder passwordEncoder;
    private final JwtUtil jwtUtil;

    public String register(RegisterRequest request) {
        if (userRepository.existsByEmail(request.getEmail())) {
            return "Email sudah terdaftar";
        }

        if (!request.getPassword().equals(request.getConfirmPassword())) {
            return "Password dan konfirmasi password tidak cocok";
        }

        User user = new User();
        user.setName(request.getName());
        user.setEmail(request.getEmail());
        user.setPassword(passwordEncoder.encode(request.getPassword()));

        userRepository.save(user);
        return "Registrasi berhasil";
    }

    public String login(LoginRequest request) {
        Optional<User> userOpt = userRepository.findByEmail(request.getEmail());
        if (userOpt.isEmpty()) {
            return "Email tidak ditemukan";
        }

        User user = userOpt.get();
        // Cek password
        if (!passwordEncoder.matches(request.getPassword(), user.getPassword())) {
            return "Password salah";
        }

        // Generate JWT token
        String token = jwtUtil.generateToken(user.getEmail());
        return token;
    }
}
