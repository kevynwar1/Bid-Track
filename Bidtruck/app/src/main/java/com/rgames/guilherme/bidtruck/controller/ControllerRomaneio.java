package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;

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

    public List<Romaneio> select(Motorista motorista) throws Exception {
        isConnect();
        if (motorista == null) throw new NullPointerException("Motorista null");
        if (motorista.getCodigo() <= 0)
            throw new IllegalArgumentException("Motorista não esta conectado");
        if (httpRomaneio == null) httpRomaneio = new HttpRomaneio(mContext);
        return httpRomaneio.select(motorista);
    }

    public List<Romaneio> selectOffers(Motorista motorista) throws Exception {
        isConnect();
        if (motorista == null) throw new NullPointerException("Motorista null");
        if (motorista.getCodigo() <= 0)
            throw new IllegalArgumentException("Motorista não esta conectado");
        if (httpOferta == null) httpOferta = new HttpOferta(mContext);
        return httpOferta.loadOffers(motorista.getEmpresa().getCodigo(), motorista.getCodigo());
    }

    private void isConnect() {
        if (!HttpConnection.isConnected(mContext)) throw new NullPointerException("Sem conexão");
    }
}
