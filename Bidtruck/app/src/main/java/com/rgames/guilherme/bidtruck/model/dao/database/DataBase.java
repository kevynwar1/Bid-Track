package com.rgames.guilherme.bidtruck.model.dao.database;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;

import java.util.ArrayList;
import java.util.List;

import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Kevyn on 18/10/2017.
 */

public class DataBase extends SQLiteOpenHelper {

    private SQLiteDatabase conn;
    private static final String NOME_BANCO = "tecnologia177_4";
    private static final int VERSAO = 1;



    public DataBase(Context context) {
        super(context, NOME_BANCO, null, VERSAO);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        //db.execSQL(ScriptSql.getCreateTableDestinatario());
        db.execSQL(ScriptSql.getCreateTableEmpresa());
        db.execSQL(ScriptSql.getCreateTableEmpresaMotorista());
        db.execSQL(ScriptSql.getCreateTableEntrega());
        //db.execSQL(ScriptSql.getCreateTableOcorrencia());
        db.execSQL(ScriptSql.getCreateTableRomaneio());
        //db.execSQL(ScriptSql.getCreateTableStatusEntrega());
        db.execSQL(ScriptSql.getCreateTableStatusRomaneio());
        //db.execSQL(ScriptSql.getCreateTableTipoOcorrencia());

        //inserirStatusEntrega(preencheStatusEntrega());
        //Log.i("Sarah", "" + buscaStatusEntrega().size());

    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL(ScriptSql.getDropTableDestinatario());
        db.execSQL(ScriptSql.getDropTableEmpresa());
        db.execSQL(ScriptSql.getDropTableEmpresaMotorista());
        db.execSQL(ScriptSql.getDropTableEntrega());
        db.execSQL(ScriptSql.getDropTableOcorrencia());
        db.execSQL(ScriptSql.getDropTableRomaneio());
        db.execSQL(ScriptSql.getDropTableStatusEntrega());
        db.execSQL(ScriptSql.getDropTableStatusRomaneio());
        db.execSQL(ScriptSql.getDropTableTipoOcorrencia());
        this.onCreate(db);
    }



}

