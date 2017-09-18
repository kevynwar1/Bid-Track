package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Usuario;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import java.net.HttpURLConnection;

public class HttpLogin extends HttpBase<Motorista> {

    private Context mContext;

    public HttpLogin(Context context) {
        mContext = context;
    }

    public Motorista login(String[] email, String senha){
        Motorista motorista = null;
        try {
            HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_LOGIN, HttpMethods.GET, false, true,
                    new StringBuilder("/").append(email[0]).append("%40").append(email[1])
                            .append("/").append(senha).toString());
            motorista = super.selectBy(connection, Motorista.class);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return motorista;
    }

}
