package com.dht11service.dht_service;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.cloud.client.discovery.EnableDiscoveryClient;

@SpringBootApplication
@EnableDiscoveryClient
public class DhtServiceApplication {

	public static void main(String[] args) {
		SpringApplication.run(DhtServiceApplication.class, args);
	}

}
