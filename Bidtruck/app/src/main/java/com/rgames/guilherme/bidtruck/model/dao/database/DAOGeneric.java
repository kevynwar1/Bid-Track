package com.rgames.guilherme.bidtruck.model.dao.database;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import java.util.ArrayList;
import java.util.List;

abstract class DAOGeneric {

    protected DataBase base;
    protected static SQLiteDatabase db;

    DAOGeneric(Context context) {
        base = new DataBase(context);
    }

    protected long insert(String table, ContentValues contentValues) {
        return db.insert(table, null, contentValues);
    }

    protected int update(String table, String where, ContentValues contentValues, int codigo) {
        return db.update(table, contentValues, where, new String[]{String.valueOf(codigo)});
    }

    protected int delete(String table, String where, int codigo) {
        return db.delete(table, where, new String[]{String.valueOf(codigo)});
    }

    protected List<Object> select(String query, Object object, SQLTable table, String[] where) {
        List<Object> list = new ArrayList<>();
        Cursor cursor = db.rawQuery(query, where);
        while (cursor.moveToNext()) {
            list.add(SQLCursor.get(object, cursor, table));
        }
        return list;
    }
}
