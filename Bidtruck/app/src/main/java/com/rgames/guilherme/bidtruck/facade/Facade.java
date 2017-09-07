package com.rgames.guilherme.bidtruck.facade;

import android.content.Context;
import android.os.AsyncTask;

import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;

public class Facade implements IFacade {

    private Context mContext;

    public Facade(Context context) {
        mContext = context;
    }

    @Override
    public String connectionTest() {
        if (HttpConnection.isConnected(mContext))
            return HttpConnection.ConnecetinTest();
        else return "Sem conexão";
    }
}
