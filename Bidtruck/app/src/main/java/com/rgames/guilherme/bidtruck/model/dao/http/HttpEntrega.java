package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import org.json.JSONException;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Guilherme on 09/09/2017.
 */

public class HttpEntrega extends HttpBase<Entrega> {
    private Context mContext;

    public HttpEntrega(Context context) {
        mContext = context;
    }

    public List<Entrega> select() {
        List<Entrega> list = new ArrayList<>();
        if (HttpConnection.isConnected(mContext)) {
            try {
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_DELIVERY_FOR_DRIVER, HttpMethods.GET, false, true, "");
                list = super.select(connection, Entrega.class);
                //pode ser redundante, se houver erro tira :3
                connection.disconnect();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        return list;



    }



    /*public List<Entrega> selectById(int id) {
        List<Entrega> lista = new ArrayList<>();
         if (lista.isEmpty() ){
             if (HttpConnection.isConnected(mContext)){
                 try{
                     HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_DELIVERY_DRIVER, HttpMethods.GET, true, true, "/id");
                     connection.getOutputStream().write(String.valueOf(id).getBytes());
                     Class<Entrega> ent = super.selectBy(connection, Entrega.class);
                     Entrega nova_entrega = null;
                     nova_entrega = ent.cast(Entrega.class);
                     lista.add(nova_entrega);
                     connection.disconnect();
                 }catch (IOException e ){
                     e.printStackTrace();
                 }catch (JSONException e){
                     e.printStackTrace();
                 }

             }


         }


        return lista;
    }*/



}




