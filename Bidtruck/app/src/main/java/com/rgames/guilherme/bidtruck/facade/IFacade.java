package com.rgames.guilherme.bidtruck.facade;


import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.Usuario;
import com.rgames.guilherme.bidtruck.model.errors.MotoristaNaoConectadoException;
import com.rgames.guilherme.bidtruck.model.errors.WithoutConnectionException;

import java.util.IllegalFormatException;
import java.util.List;

public interface IFacade {

    /*Connection*/
    String connectionTest() throws WithoutConnectionException;

    boolean isConnected(Context context);

    /*Controller romaneio*/
    List<Romaneio> selectRomaneio(Empresa empresa, Motorista motorista) throws Exception;

    List<Romaneio> selectRomaneioOfertado(Motorista motorista) throws Exception;


    /*Controller entrega*/
    List<Entrega> selectEntrega()throws Exception;

    /*Controller Empresa*/
    List<Empresa> selectEmpresa(Motorista motorista) throws Exception;


    /*Controller login*/
    Motorista login(String email, String senha) throws Exception;

    Usuario login(String email)throws Exception;

    Motorista isLogged()throws Exception;

    void setLogged(Motorista motorista)throws Exception;

    boolean isMatenhaConectado()throws Exception;

    void setMatenhaConectado(boolean isConnected)throws Exception;
}
