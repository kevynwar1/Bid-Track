package com.rgames.guilherme.bidtruck.model.dao.http;

import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import java.net.HttpURLConnection;
import java.util.List;

/**
 * Created by Guilherme on 05/10/2017.
 */

public class HttpTipoOcorrencia extends HttpBase<TipoOcorrencia> {

    public List<TipoOcorrencia> select(int empresa) {
        try {
            HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_TIPO_OCORRENCIA, HttpMethods.GET, false, true, String.valueOf(empresa));
            return super.select(connection, TipoOcorrencia.class);
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }
}
