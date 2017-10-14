package com.rgames.guilherme.bidtruck.model.dao.http;

import com.google.gson.Gson;

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

public abstract class HttpBase<T> {


    /*
    * Sem teste consistente
    * */
    protected T selectBy(HttpURLConnection connection, Class<T> classT) throws IOException, JSONException {
        T objReturn = null;
        BufferedReader scanner = new BufferedReader(new InputStreamReader(connection.getInputStream()));
        StringBuilder jsonScanner = new StringBuilder();
        String line = null;
        while ((line = scanner.readLine()) != null) {
            jsonScanner.append(line).append("\n");
        }
        scanner.close();
        JSONArray jsonArray = new JSONArray(jsonScanner.toString());
        JSONObject jsonObject = null;
        for (int i = 0; i < jsonArray.length(); i++) {
            jsonObject = jsonArray.getJSONObject(i);
//            Log.i("teste", "jsonobject: " + jsonObject.toString());
            objReturn = new Gson().fromJson(String.valueOf(jsonObject), classT);
        }

//                JSONArray jsonArray = jsonObject.getJSONArray("");
//                Log.i("teste", "jsonarray: " + jsonArray.toString());
//                Type type = new TypeToken<ArrayList<Romaneio>>() {
//                }.getType();
//                list = new Gson().fromJson(String.valueOf(jsonObject), type);
        connection.disconnect();
        return objReturn;
    }

    protected List<T> select(HttpURLConnection connection, Class<T> classT) throws IOException, JSONException {
        List<T> list = new ArrayList<>();
        BufferedReader scanner = new BufferedReader(new InputStreamReader(connection.getInputStream()));
        StringBuilder jsonScanner = new StringBuilder();
        String line = null;
        while ((line = scanner.readLine()) != null) {
            jsonScanner.append(line).append("\n");
        }
        scanner.close();
        JSONArray jsonArray = new JSONArray(jsonScanner.toString());
        JSONObject jsonObject = null;
        for (int i = 0; i < jsonArray.length(); i++) {
            jsonObject = jsonArray.getJSONObject(i);
            //   Log.i("teste", "jsonobject: " + jsonObject.toString());
            list.add(new Gson().fromJson(String.valueOf(jsonObject), classT));
        }

        //      JSONArray jsonArrays = jsonObject.getJSONArray("");
        //      Log.i("teste", "jsonarray: " + jsonArray.toString());
        //      Type type = new TypeToken<ArrayList<Entrega>>() {
        //      }.getType();
        //       list = new Gson().fromJson(String.valueOf(jsonObject), type);
        connection.disconnect();
        return list;
    }

    protected boolean insert(HttpURLConnection connection, String object) throws IOException, JSONException {
        connection.getOutputStream().write(object.getBytes());
        connection.getOutputStream().flush();
        connection.getOutputStream().close();
        if (connection.getResponseCode() == 200) {
            connection.disconnect();
            return true;
        } else {
            connection.disconnect();
            return false;
        }
    }

    protected Integer insertInteiro(HttpURLConnection connection, String object) throws IOException, JSONException {
        int valor = 0;
        int status = 0;
        String json = "";

        connection.getOutputStream().write(object.getBytes());
        connection.getOutputStream().flush();
        connection.getOutputStream().close();

        BufferedReader scanner = new BufferedReader(new InputStreamReader(connection.getInputStream()));
        StringBuilder jsonScanner = new StringBuilder();
        String line = null;
        line = scanner.readLine();
        jsonScanner.append(line);
        scanner.close();
       json = jsonScanner.toString();
        JSONObject bob = new JSONObject(json);
       status = bob.getInt("status");
        valor = bob.getInt("id");
        if (status == 201 && valor > 0) {
            connection.disconnect();
            return valor;
        } else {
            connection.disconnect();
            return 0;
        }


    }
}
