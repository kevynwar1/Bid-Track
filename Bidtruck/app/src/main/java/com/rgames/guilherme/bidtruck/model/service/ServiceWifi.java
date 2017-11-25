package com.rgames.guilherme.bidtruck.model.service;

import android.app.Service;
import android.content.Intent;
import android.os.IBinder;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;

public class ServiceWifi extends Service {

    private boolean criado = false;
    private ThreadWifi threadWifi;

    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    @Override
    public void onCreate() {
        super.onCreate();
        Log.i("teste", "criado");
    }

    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        if (!criado) {
            Log.i("teste", "thread init");
            criado = true;
            threadWifi = new ThreadWifi();
            threadWifi.start();
        }
        return super.onStartCommand(intent, flags, startId);
    }

    private class ThreadWifi extends Thread {
        private boolean ativo = true;

        @Override
        public void run() {
            while (ativo) {
                try {
                    sleep(1000);
                    if(HttpConnection.isConnected(getApplicationContext())){
                        Log.i("teste", "conectado");
                    }else{
                        Log.i("teste", "nao conectado");
                    }
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
            stopSelf();
        }
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        threadWifi.ativo = false;
    }
}
