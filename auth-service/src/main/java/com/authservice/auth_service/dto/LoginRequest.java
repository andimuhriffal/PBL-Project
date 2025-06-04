package com.authservice.auth_service.dto;

import jakarta.validation.constraints.NotBlank;
import lombok.Data;

@Data
public class LoginRequest {
    
    @NotBlank(message = "Email tidak boleh kosong")
    private String email;
    
    @NotBlank(message = "Password tidak boleh kosong")
    private String password;
}
