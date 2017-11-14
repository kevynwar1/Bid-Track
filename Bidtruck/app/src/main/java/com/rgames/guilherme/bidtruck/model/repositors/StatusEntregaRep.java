package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;
import com.rgames.guilherme.bidtruck.model.dao.database.DataBase;
import com.rgames.guilherme.bidtruck.model.dao.database.StatusEntregaTable;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by C. Eduardo on 31/10/2017.
 */

public class StatusEntregaRep {

    private DataBase banco;
    private SQLiteDatabase connection;
    private boolean sucess;

    public StatusEntregaRep(Context context){

        banco = new DataBase(context);
    }



   /* public List<ContentValues> preencheStatusEntrega() {
        List<ContentValues> values = new ArrayList<>();
        ContentValues cv = new ContentValues();

        cv.put(StatusEntregaTable.CODIGO, 1);
        cv.put(StatusEntregaTable.DESCRICAO, "Liberado");
        values.add(cv);

        cv.put(StatusEntregaTable.CODIGO, 2);
        cv.put(StatusEntregaTable.DESCRICAO, "Pendente");
        values.add(cv);

        cv.put(StatusEntregaTable.CODIGO, 3);
        cv.put(StatusEntregaTable.DESCRICAO, "Em Viagem");
        values.add(cv);

        cv.put(StatusEntregaTable.CODIGO, 4);
        cv.put(StatusEntregaTable.DESCRICAO, "Finalizado");
        values.add(cv);

        return values;
    }*/

    public void inserirStatusEntrega() {
        sucess = false;
        try {

            List<ContentValues> values = new ArrayList<>();
            ContentValues cv1 = new ContentValues();
            ContentValues cv2 = new ContentValues();
            ContentValues cv3 = new ContentValues();
            ContentValues cv4 = new ContentValues();

            cv1.put(StatusEntregaTable.CODIGO, 1);
            cv1.put(StatusEntregaTable.DESCRICAO, "Liberado");
            values.add(cv1);

            cv2.put(StatusEntregaTable.CODIGO, 2);
            cv2.put(StatusEntregaTable.DESCRICAO, "Pendente");
            values.add(cv2);

            cv3.put(StatusEntregaTable.CODIGO, 3);
            cv3.put(StatusEntregaTable.DESCRICAO, "Em Viagem");
            values.add(cv3);

            cv4.put(StatusEntregaTable.CODIGO, 4);
            cv4.put(StatusEntregaTable.DESCRICAO, "Finalizado");
            values.add(cv4);

            if (buscaStatusEntrega() == null || buscaStatusEntrega().size() <= 0) {
                connection = banco.getWritableDatabase();
                for (ContentValues content : values) {
                   long resultado = connection.insertOrThrow(StatusEntregaTable.TABELA, null, content);
                    if(resultado != -1){
                        sucess = true;
                    }

                }

               connection.close();

            }
        } catch (Exception e) {
            e.printStackTrace();
        }


    }


    public List<StatusEntrega> buscaStatusEntrega() {
        List<StatusEntrega> entregas = null;
        connection = banco.getReadableDatabase();
        String sql = "SELECT * FROM " + StatusEntregaTable.TABELA;
        try {
            Cursor cursor = connection.rawQuery(sql, null);
            entregas = new ArrayList<>();
            while (cursor.moveToNext()) {
                StatusEntrega statuts = new StatusEntrega();
                statuts.setCodigo(cursor.getInt(cursor.getColumnIndex(StatusEntregaTable.CODIGO)));
                statuts.setDescricao(cursor.getString(cursor.getColumnIndex(StatusEntregaTable.DESCRICAO)));
                entregas.add(statuts);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return entregas;
    }

}
