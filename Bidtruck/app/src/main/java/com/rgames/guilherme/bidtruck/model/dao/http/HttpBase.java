package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

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

    protected List<T> select(HttpURLConnection connection) throws IOException, JSONException {
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
        Type type = null;
        for (int i = 0; i < jsonArray.length(); i++) {
            jsonObject = jsonArray.getJSONObject(i);
            Log.i("teste", "jsonobject: " + jsonObject.toString());
            type = new TypeToken<T>() {
            }.getType();
            list.add((T) new Gson().fromJson(String.valueOf(jsonObject), type));
        }

//                JSONArray jsonArray = jsonObject.getJSONArray("");
//                Log.i("teste", "jsonarray: " + jsonArray.toString());
//                Type type = new TypeToken<ArrayList<Romaneio>>() {
//                }.getType();
//                list = new Gson().fromJson(String.valueOf(jsonObject), type);
        connection.disconnect();
        return list;
    }
}
