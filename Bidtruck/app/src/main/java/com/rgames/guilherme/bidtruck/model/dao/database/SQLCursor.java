package com.rgames.guilherme.bidtruck.model.dao.database;

import android.database.Cursor;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;

public class SQLCursor {

    public static Ocorrencia ocorrencia(Cursor cursor, SQLTable table) {
        Ocorrencia ocorrencia = new Ocorrencia(
                cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_COD_EMPRESA))
                , cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_SEQ_ENTREGA))
                , cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_COD_ROMANEIO))
                , cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_COD_TIPO_OCORRENCIA))
                , cursor.getString(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_DESCRICAO)));
        ocorrencia.setSituation((char) cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_SITUACAO)));
        return ocorrencia;
    }

    public static Object get(Object object, Cursor cursor, SQLTable table) {
        if(object instanceof Ocorrencia)
            return ocorrencia(cursor, table);
        return null;
    }
}
