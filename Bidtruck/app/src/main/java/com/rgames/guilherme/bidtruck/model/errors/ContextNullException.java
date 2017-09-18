package com.rgames.guilherme.bidtruck.model.errors;

/**
 * Created by Guilherme on 14/09/2017.
 */

public class ContextNullException extends Exception {

    private String msg;

    public ContextNullException() {
    }

    public ContextNullException(String msg) {
        this.msg = msg;
    }

    @Override
    public String toString() {
        return (msg != null && !msg.trim().equals("")) ? msg
                : "O contexto da aplicação não foi reconhecido.";
    }
}
