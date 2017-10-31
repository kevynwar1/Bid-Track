package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.support.annotation.NonNull;
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

    public String inserir(Romaneio romaneio, Empresa empresa) {

        try{

          conn = banco.getReadableDatabase();
            ContentValues cv = preencheRomaneio(romaneio, empresa);
          long resultado = conn.insertOrThrow(romaneioTable.TABELA, null, cv);
          conn.close();
          if(resultado == -1){

              return "Erro";
          }
          else{
              return "Sucesso";
          }


        } catch (Exception e) {
            e.printStackTrace();
        }

           return null;

    }







    public List<Romaneio> buscarRomaneio() {
        SQLiteDatabase db = banco.getReadableDatabase();

        List<Romaneio> romaneios = null;
        try {
            String sql = "SELECT  codigo, cod_empresa, cod_status_romaneio, cod_estabelecimento, cod_motorista FROM " + romaneioTable.TABELA;
            String[] argumentos = null;

             Cursor cursorRomaneio = db.rawQuery(sql, argumentos);


            while(cursorRomaneio.moveToNext()) {
                romaneios = new ArrayList<Romaneio>();
                {
                    int codigo = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.CODIGO));
                    //String codigoEmpresa = cursorRomaneio.getString(cursorRomaneio.getColumnIndex(romaneioTable.COD_EMPRESA));
                    int codigoEstalecimento = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.COD_ESTABELECIMENTO));
                    int codigoMotorista = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.COD_MOTORISTA));
                    int codigoStatus = cursorRomaneio.getInt(cursorRomaneio.getColumnIndex(romaneioTable.COD_STATUS_ROMANEIO));

                    Romaneio romaneioBanco = new Romaneio();
                    Motorista motoristaBanco = new Motorista();
                    Estabelecimento estabelecimentoB = new Estabelecimento();
                    StatusRomaneio statusBanco = new StatusRomaneio();


                    romaneioBanco.setCodigo(codigo);
                    estabelecimentoB.setCodigo(codigoEstalecimento);
                    romaneioBanco.setEstabelecimento(estabelecimentoB);
                    motoristaBanco.setCodigo(codigoMotorista);
                    romaneioBanco.setMotorista(motoristaBanco);
                    statusBanco.setCodigo(codigoStatus);
                    romaneioBanco.setStatus_romaneio(statusBanco);


                    romaneios.add(romaneioBanco);

                    cursorRomaneio.close();
                    db.close();
                }
            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        return romaneios;
    }


}
