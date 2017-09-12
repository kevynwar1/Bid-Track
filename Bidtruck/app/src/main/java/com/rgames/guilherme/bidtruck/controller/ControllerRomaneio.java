package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;

import java.util.List;

/**
 * Created by Guilherme on 11/09/2017.
 */

public class ControllerRomaneio {
    private Context mContext;
    private HttpRomaneio httpRomaneio;

    public ControllerRomaneio(Context context) {
        mContext = context;
    }

    public List<Romaneio> select() {
        isConnect();
        if (httpRomaneio == null) httpRomaneio = new HttpRomaneio(mContext);
        return httpRomaneio.select();
    }

    private void isConnect() {
        if (!HttpConnection.isConnected(mContext)) throw new NullPointerException("Sem conexão");
    }
}
