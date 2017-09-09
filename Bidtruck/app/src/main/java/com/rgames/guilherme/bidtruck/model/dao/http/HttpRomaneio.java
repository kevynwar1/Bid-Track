package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

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
import java.util.Scanner;

public class HttpRomaneio {

    private Context mContext;

    public HttpRomaneio(Context context) {
        mContext = context;
    }

    public List<Romaneio> select() {
        List<Romaneio> list = new ArrayList<>();
        if (HttpConnection.isConnected(mContext)) {
            try {
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_ROMANEIO, HttpMethods.GET, false, true);
                BufferedReader scanner = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                StringBuilder jsonScanner = new StringBuilder();
                String line = null;
                while ((line = scanner.readLine()) != null) {
                    jsonScanner.append(line).append("\n");
                }
                scanner.close();
                JSONArray jsonArray = new JSONArray(jsonScanner.toString());
                JSONObject jsonObject = null;
                Type type = null;
                for (int i = 0; i < jsonArray.length(); i++) {
                    jsonObject = jsonArray.getJSONObject(i);
                    Log.i("teste", "jsonobject: " + jsonObject.toString());
                    type = new TypeToken<Romaneio>() {
                    }.getType();
                    list.add((Romaneio) new Gson().fromJson(String.valueOf(jsonObject), type));
                }
                Log.i("teste", "size: " + list.size());
                Log.i("teste", "id: " + list.get(0).getCodigo());
                Log.i("teste", "completo: " + list.get(0).toString());
//                JSONArray jsonArray = jsonObject.getJSONArray("");
//                Log.i("teste", "jsonarray: " + jsonArray.toString());
//                Type type = new TypeToken<ArrayList<Romaneio>>() {
//                }.getType();
//                list = new Gson().fromJson(String.valueOf(jsonObject), type);
                connection.disconnect();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        return list;
    }
}
