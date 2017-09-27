package com.rgames.guilherme.bidtruck.model.errors;

/**
 * Created by Guilherme on 26/09/2017.
 */

public class TimeoutException extends Exception {
    private String msg;

    public TimeoutException() {
    }

    public TimeoutException(String msg) {
        this.msg = msg;
    }

    @Override
    public String getMessage() {
        return (msg != null && !msg.trim().equals("")) ? msg
                : "Tempo de conexão excedido.";
    }
}
