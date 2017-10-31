package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;
import com.rgames.guilherme.bidtruck.model.dao.database.DataBase;
import com.rgames.guilherme.bidtruck.model.dao.database.EmpresaTable;
import com.rgames.guilherme.bidtruck.model.dao.database.StatusEntregaTable;

import java.util.ArrayList;
import java.util.List;

public class EmpresaRep {

    private DataBase connection;
    private EmpresaTable empresaTable;

    public EmpresaRep(Context context){
        connection = new DataBase(context);
    }

    private ContentValues preencheEmpresa(Empresa empresa){
        ContentValues cv = new ContentValues();
        cv.put(empresaTable.CODIGO, empresa.getCodigo());
        cv.put(empresaTable.NOME_FANTASIA, empresa.getNome_fantasia());
        return cv;
    }

    public boolean insertEmpresa(Empresa empresa){
        boolean retorno = false;
        try{
            SQLiteDatabase database = connection.getWritableDatabase();
            long resultado = database.insert(empresaTable.TABELA, null, preencheEmpresa(empresa));
            if(resultado != -1){
                retorno = true;
            }
        }catch (Exception e){
            e.printStackTrace();
        }
        return retorno;
    }

    public Empresa buscarEmpresa(){
        SQLiteDatabase database = connection.getReadableDatabase();
        Empresa empresa = null;
        String sql = "SELECT * FROM " + empresaTable.TABELA;
        try {
            Cursor cursor = database.rawQuery(sql, null);
            while(cursor.moveToNext()){
                empresa = new Empresa();
                empresa.setCodigo(cursor.getInt(cursor.getColumnIndex(empresaTable.CODIGO)));
                empresa.setNome_fantasia(cursor.getString(cursor.getColumnIndex(empresaTable.NOME_FANTASIA)));
            }
            database.close();
            cursor.close();
        }catch (Exception e){
            e.printStackTrace();
        }
        return empresa;
    }
}
