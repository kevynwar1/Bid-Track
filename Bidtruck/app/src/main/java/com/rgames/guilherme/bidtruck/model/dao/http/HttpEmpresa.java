package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import org.json.JSONException;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by kevyn on 18/09/2017.
 */

public class HttpEmpresa extends HttpBase<Empresa> {
    private Context context;

    public HttpEmpresa(Context context) {
        this.context = context;

    }

    public List<Empresa> selectEmpresa() {
        List<Empresa> list = new ArrayList<>();
        if (HttpConnection.isConnected(context)) {
            try {
           //     if (motorista.getCodigo() > 0) {
                    HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_COMPANY, HttpMethods.GET, false, true,"");
                    list = super.select(connection, Empresa.class);
                    connection.disconnect();
             //   }
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        return list;

    }

}
