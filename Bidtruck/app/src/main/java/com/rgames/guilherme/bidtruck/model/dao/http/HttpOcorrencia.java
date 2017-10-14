package com.rgames.guilherme.bidtruck.model.dao.http;

import android.util.Log;
import android.widget.ArrayAdapter;

import com.google.gson.JsonObject;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import org.json.JSONObject;

import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Guilherme on 03/10/2017.
 */

public class HttpOcorrencia extends HttpBase<Ocorrencia> {

    public boolean insert(Ocorrencia ocorrencia, ArrayList<String> list) {
        try {
            JSONObject jsonObject = new JSONObject();
            jsonObject.accumulate("empresa",  ocorrencia.getEmpresa().getCodigo());
            jsonObject.accumulate("entrega",  ocorrencia.getEntrega().getSeq_entrega());
            jsonObject.accumulate("romaneio",  ocorrencia.getRomaneio().getCodigo());
            jsonObject.accumulate("tipo_ocorrencia",  ocorrencia.getTipoOcorrencia().getCodigo());
            jsonObject.accumulate("descricao",  ocorrencia.getDescricao());
            jsonObject.accumulate("foto", list);

            HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_OCORRENCIA_ADD, HttpMethods.POST, true, true, "");
            return super.insert(connection, jsonObject.toString());
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        }
    }

    public List<Ocorrencia> select(int seq_entrega, int romaneio) {
        try {
            HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_OCORRENCIA_ENTREGA, HttpMethods.GET, false, true, seq_entrega + "/" + romaneio);
            return super.select(connection, Ocorrencia.class);
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }
}
