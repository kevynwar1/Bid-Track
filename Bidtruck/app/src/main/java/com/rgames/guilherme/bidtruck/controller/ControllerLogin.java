package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Usuario;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpLogin;

import java.util.concurrent.ExecutionException;

/**
 * Created by Guilherme on 11/09/2017.
 */

public class ControllerLogin {

    private HttpLogin httpLogin;
    private Context mContext;

    public ControllerLogin(Context context) {
        mContext = context;
    }

    public Motorista login(String email, String senha) throws Exception {
        if (email != null && senha != null) {
            String[] emailArray = email.split("@");
            if (httpLogin == null) httpLogin = new HttpLogin(mContext);
            if (emailArray.length == 2 && (!emailArray[0].trim().equals("") && !emailArray[1].trim().equals(""))) {
                if (!senha.trim().equals("")) {
                    Log.i("teste", emailArray[0] + " " + emailArray[1]);
                    return httpLogin.login(emailArray, senha);
                } else throw new IllegalArgumentException("Informe uma senha válida!");
            } else throw new IllegalArgumentException("Informe um email válido!");
        } else throw new NullPointerException("Dados não informados");
    }

    private static SharedPreferences instance(Context context) {
        return PreferenceManager.getDefaultSharedPreferences(context);
    }

    public Motorista isLogged() throws Exception {
        return (mContext != null)
                ? new Motorista(
                Integer.parseInt(instance(mContext).getString("prefKey_motorista_id", "0"))
                , Integer.parseInt(instance(mContext).getString("prefKey_motorista_codEmpresa", "0")))
                : null;
    }

    public void setLogged(Motorista motorista) throws Exception {
        if (mContext != null && motorista != null) {
            SharedPreferences.Editor editor = instance(mContext).edit();
            editor.putString("prefKey_motorista_id", String.valueOf(motorista.getCodigo()));
            if (motorista.getEmpresa() != null)
                editor.putString("prefKey_motorista_codEmpresa", String.valueOf(motorista.getEmpresa().getCodigo()));
            editor.apply();
            editor.commit();
        } else throw new NullPointerException("Contexto ou Motorista nulo");
    }

    public boolean isMatenhaConectado() throws Exception {
        return (mContext != null)
                && instance(mContext).getBoolean("prefKey_motorista_connected", false);
    }

    public void setMatenhaConectado(boolean isConnected) throws Exception {
        SharedPreferences.Editor editor = instance(mContext).edit();
        editor.putBoolean("prefKey_motorista_connected", isConnected);
        editor.apply();
        editor.commit();
    }

}
