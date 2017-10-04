package com.rgames.guilherme.bidtruck.model.dao.http;

import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.lang.reflect.Type;
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

    protected boolean insert(HttpURLConnection connection, Object object) throws IOException, JSONException {
        Gson gson = new Gson();
        String jsonCon = gson.toJson(object);
        connection.getOutputStream().write(jsonCon.getBytes());
        if (connection.getResponseCode() == 201) {
            connection.disconnect();
            return true;
        } else {
            connection.disconnect();
            return false;
        }
    }
}
