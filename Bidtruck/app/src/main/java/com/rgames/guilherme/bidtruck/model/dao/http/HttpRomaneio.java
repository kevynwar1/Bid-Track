package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
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
                HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_ROMANEIO, HttpMethods.GET, true, false);

                Scanner scanner = new Scanner(connection.getInputStream());
                String jsonScanner = scanner.nextLine();

                JSONObject jsonObject = new JSONObject(jsonScanner);
                JSONArray jsonArray = jsonObject.getJSONArray("results");
                Type type = new TypeToken<ArrayList<Romaneio>>() {
                }.getType();
                list = new Gson().fromJson(String.valueOf(jsonArray), type);
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
