package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

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

    public boolean acceptOffer(int codMotorista, int codRomaneio, int codEmpresa, int codEstabelecimento){
        boolean result = false;
        try {
            if(HttpConnection.isConnected(context)){
                String params = codMotorista + "/" + codRomaneio + "/" + codEmpresa + "/" + codEstabelecimento;
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_OFFER_ACCEPT, HttpMethods.GET, false, true, params);
                if(connection.getResponseCode() == HttpURLConnection.HTTP_OK){
                    InputStream is = connection.getInputStream();
                    if(is != null){
                        Scanner scanner = new Scanner(is);
                        String json = scanner.nextLine();
                        Integer.parseInt(json);
                        result = true;
                    }
                    connection.disconnect();
                }
            }
        }catch (NumberFormatException e){
            e.printStackTrace();
        } catch (Exception e){
            e.printStackTrace();
        }
        return result;
    }

    public List<Entrega> loadDeliverys(int codRomaneio){
        List<Entrega> list = new ArrayList<>();
        try{
            if(HttpConnection.isConnected(context)){
                String params = String.valueOf(codRomaneio);
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_DELIVERY_ROMANEIO, HttpMethods.GET, false, true, params);
                if(connection.getResponseCode() == HttpURLConnection.HTTP_OK){
                    //list = super.select(connection, Entrega.class);
                    connection.disconnect();
                }
            }
        }catch (Exception e){

        }
        return list;
    }


}
