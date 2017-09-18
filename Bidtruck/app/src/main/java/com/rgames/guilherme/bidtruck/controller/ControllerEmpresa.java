package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEmpresa;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;

import java.util.List;

/**
 * Created by kevyn on 18/09/2017.
 */

public class ControllerEmpresa {
    private Context context;
    private HttpEmpresa httpEmpresa;

    public ControllerEmpresa(Context context) {
        this.context = context;
    }

    public List<Empresa> selectEmpresas(Motorista motorista) throws Exception {
        isConnect();
        if (motorista == null) throw new NullPointerException("Empresa null");
        if (motorista.getCodigo() <= 0)
            throw new IllegalArgumentException("Empresa não esta conectado");
        if (httpEmpresa == null) httpEmpresa = new HttpEmpresa(context);
        return httpEmpresa.selectEmpresa(motorista);
    }


    private void isConnect() {
        if (!HttpConnection.isConnected(context)) throw new NullPointerException("Sem conexão");
    }

}
