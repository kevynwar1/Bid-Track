package com.rgames.guilherme.bidtruck.model.dao.database;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

/**
 * Created by Kevyn on 18/10/2017.
 */

public class DataBase extends SQLiteOpenHelper {

    private static final String NOME_BANCO = "tecnologia177_4";
    private static final int VERSAO = 1;

    public DataBase(Context context) {
        super(context, NOME_BANCO, null, VERSAO);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        init(db);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        init(db);
    }

    private void init(SQLiteDatabase db) {
        delete(db);
        create(db);
    }

    private void delete(SQLiteDatabase db) {
        // db.execSQL(ScriptSql.getDropTableDestinatario());
        // db.execSQL(ScriptSql.getDropTableEmpresa());
        //  db.execSQL(ScriptSql.getDropTableEmpresaMotorista());
        db.execSQL(ScriptSql.getDropTableEntrega());
        // db.execSQL(ScriptSql.getDropTableOcorrencia());
        db.execSQL(ScriptSql.getDropTableRomaneio());
        // db.execSQL(ScriptSql.getDropTableStatusEntrega());
        // db.execSQL(ScriptSql.getDropTableStatusRomaneio());
        // db.execSQL(ScriptSql.getDropTableTipoOcorrencia());
        String DELETE = "DROP TABLE IF EXISTS ";
        SQLTable table = new SQLTable();
        db.execSQL(new StringBuilder(DELETE).append(table.TB_OCORRENCIA).append(";").toString());
        db.execSQL(new StringBuilder(DELETE).append(table.TB_FOTO).append(";").toString());
        db.execSQL(new StringBuilder(DELETE).append(table.TB_TIPOCORRENCIA).append(";").toString());
    }

    private void create(SQLiteDatabase db) {
        //db.execSQL(ScriptSql.getCreateTableDestinatario());
        db.execSQL(ScriptSql.getCreateTableEmpresa());
        db.execSQL(ScriptSql.getCreateTableEmpresaMotorista());
        db.execSQL(ScriptSql.getCreateTableEntrega());
        //db.execSQL(ScriptSql.getCreateTableOcorrencia());
        db.execSQL(ScriptSql.getCreateTableRomaneio());
        //db.execSQL(ScriptSql.getCreateTableStatusEntrega());
        db.execSQL(ScriptSql.getCreateTableStatusRomaneio());
        db.execSQL(ScriptSql.getCreateTableTipoOcorrencia());

        SQLTable table = new SQLTable();
        String CREATE = "CREATE TABLE IF NOT EXISTS ";
        db.execSQL(new StringBuilder(CREATE).append(table.TB_OCORRENCIA).append(" (")
                .append(table.TB_OCORRENCIA_COL_CODIGO).append(" INTEGER PRIMARY KEY AUTOINCREMENT, ")
                .append(table.TB_OCORRENCIA_COL_COD_EMPRESA).append(" INTEGER NOT NULL, ")
                .append(table.TB_OCORRENCIA_COL_SEQ_ENTREGA).append(" INTEGER NOT NULL, ")
                .append(table.TB_OCORRENCIA_COL_COD_ROMANEIO).append(" INTEGER NOT NULL, ")
                .append(table.TB_OCORRENCIA_COL_COD_TIPO_OCORRENCIA).append(" INTEGER NOT NULL, ")
                .append(table.TB_OCORRENCIA_COL_DESCRICAO).append(" TEXT NOT NULL, ")
                .append(table.TB_OCORRENCIA_COL_SITUACAO).append(" CHAR); ")
                .toString());

        db.execSQL(new StringBuilder(CREATE).append(table.TB_FOTO).append(" (")
                .append(table.TB_FOTO_COL_CODIGO).append(" INTEGER PRIMARY KEY AUTOINCREMENT, ")
                .append(table.TB_FOTO_COL_ID).append(" INTEGER NOT NULL, ")
                .append(table.TB_FOTO_COL_ISPORTRAIT).append(" INTEGER DEFAULT 0, ")
                .append(table.TB_FOTO_COL_COD_OCORRENCIA).append(" INTEGER NOT NULL, ")
                .append(table.TB_FOTO_COL_FOTO).append(" TEXT NOT NULL); ")
                .toString());

        db.execSQL(new StringBuilder(CREATE).append(table.TB_TIPOCORRENCIA).append(" (")
                .append(table.TB_TIPOCORRENCIA_COL_CODIGO).append(" INTEGER PRIMARY KEY AUTOINCREMENT, ")
                .append(table.TB_TIPOCORRENCIA_COL_COD_EMPRESA).append(" INTEGER NOT NULL, ")
                .append(table.TB_TIPOCORRENCIA_COL_COD_DESCRICAO).append(" TEXT NOT NULL, ")
                .append(table.TB_TIPOCORRENCIA_COL_COD_SITUACAO).append(" CHAR); ")
                .toString());
        //inserirStatusEntrega(preencheStatusEntrega());
        //Log.i("Sarah", "" + buscaStatusEntrega().size());
    }
}

