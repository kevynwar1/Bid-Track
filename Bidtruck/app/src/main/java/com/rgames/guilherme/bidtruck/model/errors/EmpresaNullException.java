package com.rgames.guilherme.bidtruck.model.errors;

/**
 * Created by Guilherme on 25/09/2017.
 */

public class EmpresaNullException extends Exception {

    private String msg;

    public EmpresaNullException() {
    }

    public EmpresaNullException(String msg) {
        this.msg = msg;
    }

    @Override
    public String getMessage() {
        return (msg != null && !msg.trim().equals("")) ? msg
                : "Empresa não foi encontrada.";
    }
}
