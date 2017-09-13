package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Usuario;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import java.net.HttpURLConnection;

/**
 * Created by kevyn on 12/09/2017.
 */

public class HttpUsuario extends HttpBase<Usuario> {

    private Context mContext;

    public HttpUsuario(Context context) {
        mContext = context;
    }

    public Usuario login(String[] email) throws Exception {
        Usuario usuario = null;
        try {
            HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_USER, HttpMethods.GET, false, true,
                    new StringBuilder("/").append(email[0]).append("%40").append(email[1])
                            .append("/").toString());
            usuario = super.selectBy(connection, Usuario.class);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return usuario;
    }
}
