package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import org.json.JSONException;

import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class HttpRomaneio extends HttpBase<Romaneio> {

    private Context mContext;

    public HttpRomaneio(Context context) {
        mContext = context;
    }

    public List<Romaneio> select(Empresa empresa, Motorista motorista) {
        List<Romaneio> list = new ArrayList<>();
        if (HttpConnection.isConnected(mContext)) {
            try {
                String params = "/" + empresa.getCodigo() + "/" + motorista.getCodigo();
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_ROMANEIO_EMPRESA, HttpMethods.GET, false, true, params);
                list = super.select(connection, Romaneio.class);
                connection.disconnect();
            } catch (IOException | JSONException e) {
                e.printStackTrace();
            }
        }
        return list;
    }


    public List<Romaneio> selectNovaLista(Empresa empresa, Motorista motorista) {
        List<Romaneio> list1 = new ArrayList<>();
        if (HttpConnection.isConnected(mContext)) {
            try {
                String params = "/" + empresa.getCodigo() + "/" + motorista.getCodigo();
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_ROMANEIO_EMPRESA_NOVA, HttpMethods.GET, false, true, params);
                list1 = super.select(connection, Romaneio.class);
                connection.disconnect();
            } catch (IOException | JSONException e) {
                e.printStackTrace();
            }
        }
        return list1;
    }


    public boolean statusRomaneioEntrega(int cod_status_romaneio, int codigo) {
        boolean retorno = false;

        try {
            if (HttpConnection.isConnected(mContext)) {
                String parms = cod_status_romaneio + "/" + codigo;
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_STATUS_ROMANEIO, HttpMethods.GET, false, true, parms);
                if (connection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                    int id = connection.getResponseCode();

                    InputStream input = connection.getInputStream();
                    if (input != null) {
                        Scanner scan = new Scanner(input);
                        String json = scan.nextLine();
                        //Integer.parseInt(json);
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













    public Romaneio selectById(int id) {
        Romaneio romaneioReturn = null;
        if (HttpConnection.isConnected(mContext)) {
            try {
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_ROMANEIO, HttpMethods.GET, true, true, "/id");
                connection.getOutputStream().write(String.valueOf(id).getBytes());
                romaneioReturn = super.selectBy(connection, Romaneio.class);
                connection.disconnect();
            } catch (IOException | JSONException e) {
                e.printStackTrace();
            }
        }
        return romaneioReturn;
    }
}
