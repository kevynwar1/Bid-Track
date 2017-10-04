package com.rgames.guilherme.bidtruck.model.dao.http;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import java.net.HttpURLConnection;

/**
 * Created by Guilherme on 03/10/2017.
 */

public class HttpOcorrencia extends HttpBase<Ocorrencia> {

    public boolean insert(Ocorrencia ocorrencia) {
        try {
            HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_OCORRENCIA, HttpMethods.POST, true, true, "");
            return super.insert(connection, ocorrencia);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return false;
    }
}
