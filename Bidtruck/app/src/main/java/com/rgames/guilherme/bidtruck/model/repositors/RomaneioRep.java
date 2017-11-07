package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.support.annotation.NonNull;
import android.util.Log;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Estabelecimento;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.StatusRomaneio;
import com.rgames.guilherme.bidtruck.model.dao.database.DataBase;
import com.rgames.guilherme.bidtruck.model.dao.database.RomaneioTable;

import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Iterator;
import java.util.List;
import java.util.ListIterator;

/**
 * Created by C. Eduardo on 29/10/2017.
 */

public class RomaneioRep {

    private DataBase banco;
    private SQLiteDatabase conn;
    private RomaneioTable romaneioTable;
    private boolean success;

    public RomaneioRep(Context context) {
        banco = new DataBase(context);
    }

    private ContentValues preencheRomaneio(Romaneio romaneio, Empresa empresa){
        ContentValues cv = new ContentValues();
        cv.put(romaneioTable.CODIGO, romaneio.getCodigo());
        cv.put(romaneioTable.COD_EMPRESA, empresa.getCodigo());
        cv.put(romaneioTable.COD_ESTABELECIMENTO, romaneio.getEstabelecimento().getCodigo());
        cv.put(romaneioTable.COD_MOTORISTA, romaneio.getMotorista().getCodigo());
        cv.put(romaneioTable.COD_STATUS_ROMANEIO, romaneio.getStatus_romaneio().getCodigo());

        return cv;
    }

    public boolean inserir(Romaneio romaneio, Empresa empresa) {
        success = false;
        try{
            SQLiteDatabase database = banco.getWritableDatabase();
            ContentValues cv = preencheRomaneio(romaneio, empresa);

            long resultado = database.insertOrThrow(romaneioTable.TABELA, null, cv);
            database.close();
            if(resultado != -1){
                success = true;
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
        return success;
    }


    public long atualizaEntrega(Romaneio romaneio) {
        long resultado = 0;
        success = false;
        ContentValues cv = new ContentValues();
        cv.put(romaneioTable.CODIGO, romaneio.getCodigo());
        cv.put(romaneioTable.COD_STATUS_ROMANEIO, romaneio.getStatus_romaneio().getCodigo());


        try {

            String[] args = {String.valueOf(romaneio.getCodigo())};
            SQLiteDatabase data = banco.getWritableDatabase();
            resultado = data.update(romaneioTable.TABELA, cv, romaneioTable.CODIGO + " = ? " , args);
            data.close();

            if (resultado != -1) {
                success = true;
            }


        } catch (Exception e) {
            e.printStackTrace();
        }
        return resultado;

    }





















    public List<Romaneio> buscarRomaneio() {
        SQLiteDatabase db = banco.getReadableDatabase();
        List<Romaneio> romaneios = null;
        try {
            String sql = "SELECT codigo, cod_empresa, cod_status_romaneio, cod_estabelecimento, cod_motorista FROM " + romaneioTable.TABELA;
            String[] argumentos = null;
            Cursor cursorRomaneio = db.rawQuery(sql, argumentos);
            romaneios = new ArrayList<Romaneio>();

            while(cursorRomaneio.moveToNext()) {
                int codigo = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.CODIGO));
                //String codigoEmpresa = cursorRomaneio.getString(cursorRomaneio.getColumnIndex(romaneioTable.COD_EMPRESA));
                int codigoEstalecimento = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.COD_ESTABELECIMENTO));
                int codigoMotorista = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.COD_MOTORISTA));
                int codigoStatus = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.COD_STATUS_ROMANEIO));


                Motorista motoristaBanco = new Motorista();
                Estabelecimento estabelecimentoB = new Estabelecimento();
                StatusRomaneio statusBanco = new StatusRomaneio();
                Romaneio romaneioBanco = new Romaneio();

                romaneioBanco.setCodigo(codigo);
                romaneioBanco.setEstabelecimento(estabelecimentoB);
                motoristaBanco.setCodigo(codigoMotorista);
                romaneioBanco.setMotorista(motoristaBanco);
                statusBanco.setCodigo(codigoStatus);
                romaneioBanco.setStatus_romaneio(statusBanco);
                estabelecimentoB.setCodigo(codigoEstalecimento);
                romaneioBanco.setEstabelecimento(estabelecimentoB);

                romaneios.add(romaneioBanco);
            }
            cursorRomaneio.close();
            db.close();
        } catch (Exception e) {
            e.printStackTrace();
        }

        return romaneios;
    }


}
