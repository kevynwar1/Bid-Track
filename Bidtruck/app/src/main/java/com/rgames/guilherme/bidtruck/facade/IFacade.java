package com.rgames.guilherme.bidtruck.facade;


import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.util.List;

public interface IFacade {

    /*Connection*/
    String connectionTest();

    boolean isConnected(Context context);

    /*Controller romaneio*/
    List<Romaneio> selectRomaneio() throws Exception;

    /*Controller entrega*/
    List<Entrega> selectEntrega() throws Exception;

    /*Controller login*/
    Motorista login(String email, String senha) throws Exception;

    Motorista isLogged() throws Exception;

    void setLogged(Motorista motorista) throws Exception;

    boolean isMatenhaConectado() throws Exception;

    void setMatenhaConectado(boolean isConnected) throws Exception;
}
