package com.rgames.guilherme.bidtruck.model.dao.http;
import android.content.Context;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.List;

public class HttpOferta extends HttpBase<Romaneio>{

    private Context context;

    public HttpOferta(Context context){
        this.context = context;
    }

    public List<Romaneio> loadOffers(int empresa, int motorista){
        List<Romaneio> offers = new ArrayList<>();
        try {
            if(HttpConnection.isConnected(context)){
                String params = empresa + "/" + motorista;
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_OFFER,HttpMethods.GET, false, true, params);
                if(connection.getResponseCode() == HttpURLConnection.HTTP_OK){
                    offers = super.select(connection, Romaneio.class);
                    connection.disconnect();
                }
            }
        }catch (Exception e){
            e.printStackTrace();
        }
        return offers;
    }
}
