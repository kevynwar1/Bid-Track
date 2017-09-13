package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Usuario;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpUsuario;

/**
 * Created by kevyn on 12/09/2017.
 */

public class ControllerUsuario {
    private HttpUsuario httpUsuario;
    private Context mContext;

    public ControllerUsuario(Context context) {
        mContext = context;
    }

    public Usuario login(String email) throws Exception {
        if (email != null) {
            String[] emailArray = email.split("@");
            if (httpUsuario == null) httpUsuario = new HttpUsuario(mContext);
            if (emailArray.length == 2 && (!emailArray[0].trim().equals("") && !emailArray[1].trim().equals(""))) {
                Log.i("teste", emailArray[0] + " " + emailArray[1]);
                return httpUsuario.login(emailArray);
            } else throw new IllegalArgumentException("Informe um email válido!");
        } else throw new NullPointerException("Dados não informados");
    }
}
