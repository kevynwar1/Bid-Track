package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.dao.config.HttpMethods;
import com.rgames.guilherme.bidtruck.model.dao.config.URLDictionary;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;

public class HttpConnection {

    private HttpConnection() {
    }

    public static HttpURLConnection newInstance(URLDictionary configUrl, HttpMethods metodo, boolean doOutput, boolean doInput) throws IOException {
        URL url = new URL(configUrl.getValue());
        HttpURLConnection connection = (HttpURLConnection) url.openConnection();
        connection.setReadTimeout(10000);
        connection.setConnectTimeout(15000);
        connection.setRequestMethod(metodo.getValue());
        connection.setDoInput(doInput);
        connection.setDoOutput(doOutput);
        if (doOutput)
            connection.setRequestProperty("Content-Type", "application/json");
        connection.connect();
        return connection;
    }

    public static String ConnecetinTest() {
        String ret = null;
        try {
            HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_MAIN, HttpMethods.GET, true, false);
            ret = String.valueOf(connection.getResponseCode());
            ret = new StringBuilder(connection.getResponseCode()).append(" ").append(connection.getResponseMessage()).toString();
            connection.disconnect();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return ret;
    }

    public static boolean isConnected(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return (networkInfo != null && networkInfo.isConnected());
    }
}
