package com.rgames.guilherme.bidtruck.facade;


import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.util.List;

public interface IFacade {

    String connectionTest();

    List<Romaneio> selectRomaneio() throws Exception;

    List<Entrega> selectEntrega() throws Exception;

    /*Controller login*/
    Motorista login(String email, String senha) throws Exception;

    Motorista isLogged() throws Exception;

    void setLogged(Motorista motorista) throws Exception;

    boolean isMatenhaConectado() throws Exception;

    void setMatenhaConectado(boolean isConnected) throws Exception;
}
