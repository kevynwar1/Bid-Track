package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;

import com.rgames.guilherme.bidtruck.model.basic.Destinatario;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.database.DataBase;
import com.rgames.guilherme.bidtruck.model.dao.database.DestinatarioTable;
import com.rgames.guilherme.bidtruck.model.dao.database.RomaneioTable;

/**
 * Created by C. Eduardo on 30/10/2017.
 */

public class DestinatarioRep {


    private DataBase banco;
    private SQLiteDatabase conn;
    private DestinatarioTable destinatarioTable;

    public DestinatarioRep(Context context) {
        banco = new DataBase(context);
    }


    private ContentValues preencheDestinatario(Destinatario destinatario){
        ContentValues cv = new ContentValues();

        cv.put(destinatarioTable.CODIGO, destinatario.getId());
        //cv.put(destinatarioTable.COD_EMPRESA,destinatario.getEmpresa().getCodigo());
        cv.put(destinatarioTable.BAIRRO,destinatario.getBairro());
        cv.put(destinatarioTable.CEP,destinatario.getCEP());
        cv.put(destinatarioTable.CIDADE,destinatario.getCidade());
        cv.put(destinatarioTable.NUMERO,destinatario.getNumero());
        cv.put(destinatarioTable.LOGRADOURO,destinatario.getLogradouro());
        cv.put(destinatarioTable.NOME_FANTASIA,destinatario.getNome_fantasia());
        cv.put(destinatarioTable.RAZAO_SOCIAL,destinatario.getRazao_social());
        cv.put(destinatarioTable.UF,destinatario.getUF());
        cv.put(destinatarioTable.TELEFONE,destinatario.getTelefone());
        cv.put(destinatarioTable.LATITUDE,destinatario.getLatitude());
        cv.put(destinatarioTable.LONGITUDE,destinatario.getLongitude());


        return cv;

    }

    public String inserirDestinatario(Destinatario destinatario) {

        try{

            conn = banco.getReadableDatabase();
            ContentValues cv = preencheDestinatario(destinatario);
            long resultado = conn.insertOrThrow(destinatarioTable.TABELA, null, cv);
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
}
