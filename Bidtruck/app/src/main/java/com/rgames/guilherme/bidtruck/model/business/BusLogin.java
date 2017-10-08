package com.rgames.guilherme.bidtruck.model.business;

import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.errors.ContextNullException;
import com.rgames.guilherme.bidtruck.model.errors.EmpresaNullException;

/**
 * Created by Guilherme on 07/10/2017.
 */

public class BusLogin {

    private final Context mContext;

    public BusLogin(Context context){
        mContext = context;
    }

    public void setIdEmpresa(Empresa empresa) throws EmpresaNullException {
        if (empresa != null) {
            SharedPreferences.Editor editor = instance(mContext).edit();
            editor.putInt("prefKey_empresa_id", empresa.getCodigo());
            editor.apply();
            editor.commit();
        } else
            throw new EmpresaNullException();
    }

    public int getIdEmpresa() {
        return (mContext != null)
                ? instance(mContext).getInt("prefKey_empresa_id", 1) : 0;
    }

    private static SharedPreferences instance(Context context) {
        if (context == null) try {
            throw new ContextNullException();
        } catch (ContextNullException e) {
            e.printStackTrace();
        }
        return PreferenceManager.getDefaultSharedPreferences(context);
    }
}
