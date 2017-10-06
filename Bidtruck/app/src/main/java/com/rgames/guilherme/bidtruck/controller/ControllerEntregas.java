package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.errors.WithoutConnectionException;

import java.util.List;

/**
 * Created by Guilherme on 11/09/2017.
 */

public class ControllerEntregas {

    private Context mContext;
    private HttpEntrega httpEntrega;

    public ControllerEntregas(Context context) {
        mContext = context;
    }

    public ControllerEntregas() {

    }


    public List<Entrega> select(){
        if (httpEntrega == null) httpEntrega = new HttpEntrega(mContext);
        return httpEntrega.select();
    }


    /*public Entrega atualizaEntrega(Entrega enntrega){
        if (httpEntrega == null) httpEntrega = new HttpEntrega(mContext);
        return httpEntrega.atualizar(enntrega);

    }*/
}
