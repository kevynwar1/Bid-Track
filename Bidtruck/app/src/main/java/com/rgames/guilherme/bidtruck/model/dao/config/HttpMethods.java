package com.rgames.guilherme.bidtruck.model.dao.config;

public enum HttpMethods {

    POST("POST"), GET("GET"), PUT("PUT"), DELETE("DELETE");

    private String value;

    HttpMethods(String value) {
        this.value = value;
    }

    public String getValue() {
        return value;
    }
}
