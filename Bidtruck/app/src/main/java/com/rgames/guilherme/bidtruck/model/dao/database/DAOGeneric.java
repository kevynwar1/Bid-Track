package com.rgames.guilherme.bidtruck.model.dao.database;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import java.util.ArrayList;
import java.util.List;

public abstract class DAOGeneric {

    protected DAOGeneric(Context context) {

    }

    protected long insert(String table, ContentValues contentValues) {
        SQLiteDatabase db = null;
        long idInserido = db.insert(table, null, contentValues);
        db.close();
        return idInserido;
    }

    protected int update(String table, String where, ContentValues contentValues, int codigo) {
        SQLiteDatabase db = null;
        int affectedRows = db.update(table, contentValues, where, new String[]{String.valueOf(codigo)});
        db.close();
        return affectedRows;
    }

    protected int delete(String table, String where, int codigo) {
        SQLiteDatabase db = null;
        int affectedRows = db.delete(table, where, new String[]{String.valueOf(codigo)});
        db.close();
        return affectedRows;
    }

    protected List<Object> select(String query, Object object, SQLTable table) {
        SQLiteDatabase db = null;
        List<Object> list = new ArrayList<>();
        Cursor cursor = db.rawQuery(query, null);
        while (cursor.moveToNext()){
            list.add(SQLCursor.get(object, cursor, table));
        }
        db.close();
        return list;
    }
}
