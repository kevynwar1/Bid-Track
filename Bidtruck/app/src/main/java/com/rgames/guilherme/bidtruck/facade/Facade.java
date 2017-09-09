package com.rgames.guilherme.bidtruck.facade;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;

import java.util.List;

public class Facade implements IFacade {

    private Context mContext;
    private HttpRomaneio httpRomaneio;

    public Facade(Context context) {
        mContext = context;
    }

    @Override
    public String connectionTest() {
        if (HttpConnection.isConnected(mContext))
            return HttpConnection.ConnecetinTest();
        else return "Sem conexão";
    }

    @Override
    public List<Romaneio> selectRomaneio() throws Exception{
        if (httpRomaneio == null)
            httpRomaneio = new HttpRomaneio(mContext);
        return httpRomaneio.select();
    }
}
