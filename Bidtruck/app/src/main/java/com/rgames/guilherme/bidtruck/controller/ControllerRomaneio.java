package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;
import com.rgames.guilherme.bidtruck.model.errors.MotoristaNaoConectadoException;

import java.util.List;

/**
 * Created by Guilherme on 11/09/2017.
 */

public class ControllerRomaneio {
    private Context mContext;
    private HttpRomaneio httpRomaneio;
    private HttpOferta httpOferta;

    public ControllerRomaneio(Context context) {
        mContext = context;
    }

    public List<Romaneio> select(Empresa empresa, Motorista motorista) throws MotoristaNaoConectadoException {
        if (motorista == null || motorista.getCodigo() <= 0)
            throw new MotoristaNaoConectadoException();
        if (httpRomaneio == null) httpRomaneio = new HttpRomaneio(mContext);
        return httpRomaneio.select(empresa, motorista);
    }

    public List<Romaneio> selectOffers(Motorista motorista) throws NullPointerException, MotoristaNaoConectadoException {
        if (motorista == null)
            throw new NullPointerException(mContext.getString(R.string.app_err_null_motorista));
        if (motorista.getCodigo() <= 0)
            throw new MotoristaNaoConectadoException();
        if (httpOferta == null) httpOferta = new HttpOferta(mContext);
        return httpOferta.loadOffers(motorista.getEmpresa().getCodigo(), motorista.getCodigo());
        //return null;
    }
}
