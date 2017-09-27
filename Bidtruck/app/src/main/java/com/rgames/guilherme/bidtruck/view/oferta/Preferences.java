package com.rgames.guilherme.bidtruck.view.oferta;

import android.content.Context;
import android.content.SharedPreferences;

/**
 * Created by Erick on 26/09/2017.
 */

public class Preferences {
    private SharedPreferences preferences;
    private SharedPreferences.Editor editor;
    private static final String FILE_NAME = "bidtrack.offer";
    private static final String COMPANY_CODE = "code";

    public Preferences(Context context){
        this.preferences = context.getSharedPreferences(FILE_NAME, Context.MODE_PRIVATE);
        editor = preferences.edit();
    }

    public void setCompanyCode(int companyCode){
        if(companyCode != 0){
            this.editor.putInt(COMPANY_CODE, companyCode);
            this.editor.commit();
        }
    }

    public int getCompanyCode(){
        return preferences.getInt(COMPANY_CODE, 0);
    }
}
