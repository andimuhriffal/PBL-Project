package com.rtcservice.rtc_service;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.scheduling.annotation.EnableScheduling;

@SpringBootApplication
@EnableScheduling
public class RtcServiceApplication {

	public static void main(String[] args) {
		SpringApplication.run(RtcServiceApplication.class, args);
	}

}
