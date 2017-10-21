package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.rgames.guilherme.bidtruck.controller.ControllerEntregas;
import com.rgames.guilherme.bidtruck.controller.ControllerLogin;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

/**
 * Created by Guilherme on 09/09/2017.
 */

public class HttpEntrega extends HttpBase<Entrega> {
    private Context mContext;
    Facade mFacade;
    private Integer id_motorista_entrega;
    ControllerLogin controlLogin;

    public HttpEntrega(Context context) {
        mContext = context;
    }



    public List<Entrega> select() {
        List<Entrega> list = new ArrayList<>();
        if (HttpConnection.isConnected(mContext)) {


            try {
                controlLogin = new ControllerLogin(mContext);
                // mFacade = new Facade(mContext);


                //Motorista driver = mFacade.isLogged();
                Motorista driver = controlLogin.isLogged();
                this.id_motorista_entrega = driver.getCodigo();

                if (id_motorista_entrega > 0 && !id_motorista_entrega.equals("")) {
                    HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_ENTREGA_ROMANEIO, HttpMethods.GET, false, true, String.valueOf(id_motorista_entrega));
                    list = super.select(connection, Entrega.class);
                    //pode ser redundante, se houver erro tira :3
                    connection.disconnect();
                }


            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        return list;


    }

    public boolean statusEntrega(int cod_status_entrega, int seq_entrega, int cod_romaneio) {
        boolean retorno = false;

        try {
            if (HttpConnection.isConnected(mContext)) {
                String parms = cod_status_entrega + "/" + seq_entrega + "/" + cod_romaneio;
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_STATUS_ENTREGA, HttpMethods.GET, false, true, parms);
                if (connection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                    int id = connection.getResponseCode();


                    InputStream input = connection.getInputStream();
                    if (input != null) {
                        Scanner scan = new Scanner(input);
                        String json = scan.nextLine();
                        Integer.parseInt(json);
                        retorno = true;

                    }
                    connection.disconnect();
                }

            }
        }catch (NumberFormatException e){
            e.printStackTrace();
        } catch (Exception e){
            e.printStackTrace();
        }

        return  retorno;
    }

    public List<Entrega> selectByRomaneio(int codRomaneio){
        List<Entrega> deliverys = new ArrayList<>();
        try{
            if(HttpConnection.isConnected(mContext)){
                String params = String.valueOf(codRomaneio);
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_DELIVERY_ROMANEIO, HttpMethods.GET, false, true, params);
                if(connection.getResponseCode() == connection.HTTP_OK){
                    deliverys = super.select(connection, Entrega.class);
                    connection.disconnect();
                }
            }
        }catch (Exception e){
            e.printStackTrace();
        }
        return  deliverys;
     }

    public boolean statusEntregaUltima(int status_entrega, int cod_seq_entrega, int cod_romaneioo) {
        boolean retorno = false;

        try {
            if (HttpConnection.isConnected(mContext)) {
                String parms = status_entrega + "/" + cod_seq_entrega + "/" + cod_romaneioo;
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_NOVO_STATUS_ENTREGA, HttpMethods.GET, false, true, parms);
                if (connection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                    int idStatus = connection.getResponseCode();

                    InputStream input = connection.getInputStream();
                    if (input != null) {
                        Scanner scan = new Scanner(input);
                        String json = scan.nextLine();
                        Integer.parseInt(json);
                        retorno = true;

                    }
                    connection.disconnect();
                }

            }
        }catch (NumberFormatException e){
            e.printStackTrace();
        } catch (Exception e){
            e.printStackTrace();
        }

        return  retorno;
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




