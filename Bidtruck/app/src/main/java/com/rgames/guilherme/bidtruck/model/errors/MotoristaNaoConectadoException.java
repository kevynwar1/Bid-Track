package com.rgames.guilherme.bidtruck.model.errors;

/**
 * Created by Guilherme on 14/09/2017.
 */

public class MotoristaNaoConectadoException extends Exception{
    private String msg;

    public MotoristaNaoConectadoException() {
    }

    public MotoristaNaoConectadoException(String msg) {
        this.msg = msg;
    }

    @Override
    public String toString() {
        return (msg != null && !msg.trim().equals("")) ? msg
                : "Dados de autenticação não foram encontrados.";
    }
}
