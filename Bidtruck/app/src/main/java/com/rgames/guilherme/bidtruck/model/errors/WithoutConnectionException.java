package com.rgames.guilherme.bidtruck.model.errors;

/**
 * Created by Guilherme on 14/09/2017.
 */

public class WithoutConnectionException extends Exception {

    private String msg;

    public WithoutConnectionException() {
    }

    public WithoutConnectionException(String msg) {
        this.msg = msg;
    }

    @Override
    public String toString() {
        return (msg != null && !msg.trim().equals("")) ? msg
                : "Conexão com internet não foi encontra, verifique sua conexão para prosseguir.";
    }
}
