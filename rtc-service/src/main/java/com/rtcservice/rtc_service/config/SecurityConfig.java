package com.rtcservice.rtc_service.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;

@Configuration
@EnableWebSecurity
public class SecurityConfig {

    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
            .csrf(csrf -> csrf.disable()) // ESP8266 tidak kirim CSRF token
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/api/rtc-time").permitAll() // izinkan tanpa auth
                .requestMatchers("/api/**").permitAll()       // atau izinkan semua API
                .anyRequest().authenticated()
            );

        return http.build();
    }
}
