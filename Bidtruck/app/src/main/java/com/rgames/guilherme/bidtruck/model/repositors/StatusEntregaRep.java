package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
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



    public List<ContentValues> preencheStatusEntrega() {
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
    }

    public void inserirStatusEntrega(List<ContentValues> list) {
        try {
            if (buscaStatusEntrega() == null || buscaStatusEntrega().size() <= 0) {
                connection = banco.getWritableDatabase();
                for (ContentValues cv : list) {
                    connection.insertOrThrow(StatusEntregaTable.TABELA, null, cv);
                }
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
