package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEmpresa;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;
import com.rgames.guilherme.bidtruck.model.errors.MotoristaNaoConectadoException;

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
        if (motorista == null || motorista.getCodigo() <= 0)
            throw new MotoristaNaoConectadoException();
        if (httpEmpresa == null) httpEmpresa = new HttpEmpresa(context);
        return httpEmpresa.selectEmpresa(motorista);
    }

}
