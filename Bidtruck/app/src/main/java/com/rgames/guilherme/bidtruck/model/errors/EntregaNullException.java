package com.rgames.guilherme.bidtruck.model.errors;

/**
 * Created by Guilherme on 05/10/2017.
 */

public class EntregaNullException extends Exception{

    private String msg;

    public EntregaNullException() {
    }

    public EntregaNullException(String msg) {
        this.msg = msg;
    }

    @Override
    public String getMessage() {
        return (msg != null && !msg.trim().equals("")) ? msg
                : "A entrega não foi encontrada.";
    }
}
