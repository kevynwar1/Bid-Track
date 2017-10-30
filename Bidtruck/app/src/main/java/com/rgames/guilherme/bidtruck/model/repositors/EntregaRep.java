package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Estabelecimento;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.StatusRomaneio;
import com.rgames.guilherme.bidtruck.model.dao.database.DataBase;
import com.rgames.guilherme.bidtruck.model.dao.database.DestinatarioTable;
import com.rgames.guilherme.bidtruck.model.dao.database.EntregaTable;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by C. Eduardo on 30/10/2017.
 */

public class EntregaRep {


    private SQLiteDatabase conn;
    private EntregaTable entregaTable;
    private DataBase banco;

    public EntregaRep (Context context){
        banco = new DataBase(context);

    }

    private ContentValues preencheEntrega(Entrega entrega, Romaneio romaneio){
        ContentValues cv = new ContentValues();
        cv.put(entregaTable.COD_ROMANEIO, romaneio.getCodigo());
        cv.put(entregaTable.COD_DESTINATARIO, entrega.getDestinatario().getId());
        cv.put(entregaTable.COD_STATUS_ENTREGA, entrega.getStatusEntrega().getCodigo());
        cv.put(entregaTable.SEQ_ENTREGA,entrega.getSeq_entrega());
        cv.put(entregaTable.PESO_CARGA,entrega.getPeso());
        cv.put(entregaTable.NOTA_FISCAL,entrega.getNota_fiscal());


        return cv;

    }

    public String inserirEntrega(Entrega entrega, Romaneio romaneio) {

        try{

            conn = banco.getReadableDatabase();
            ContentValues cv = preencheEntrega(entrega, romaneio);
            long resultado = conn.insertOrThrow(entregaTable.TABELA, null, cv);
            conn.close();
            if(resultado == -1){

                return "Sucesso";
            }
            else{
                return "Erro";
            }


        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;

    }


    public List<Entrega> buscarEntrega() {
        SQLiteDatabase db = banco.getReadableDatabase();

        List<Entrega> entregas = null;
        try {
            String sql = "select e.seq_entrega, e.cod_romaneio, e.cod_destinatario, e.cod_status_entrega,e.peso_carga,e.nota_fiscal " +
                          " d.bairro,d.cep,d.cidade,d.logradouro, d.nome_fantasia, d.razao_social, d.uf, d.telefone, s.codigo, s.descricao, d.latitude, d.longitude" +
                          " From entrega as e Inner join romaneio as r on e.cod_romaneio = r.codigo" +
                          " Inner join destinatario as d on e.cod_destinatario = d.codigo " +
                          " Inner Join status_entrega as s on e.cod_status_entrega = s.codigo  WHERE e.cod_romaneio = 8541; " + entregaTable.TABELA;
            String[] argumentos = null;

            Cursor cursorEntrega = db.rawQuery(sql, argumentos);


            while(cursorEntrega.moveToNext()) {
                entregas = new ArrayList<Entrega>();
                {



                    int sequencia = cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.SEQ_ENTREGA));
                    int codigo_romaneio = cursorEntrega.getInt(cursorEntrega.getColumnIndex((entregaTable.COD_ROMANEIO)));
                    int cod_destinatario = cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.COD_DESTINATARIO));
                    int cod_status = cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.COD_STATUS_ENTREGA));
                    int nota_fiscal = cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.NOTA_FISCAL));
                    int peso = cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.PESO_CARGA));


                    db.close();
                }
            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;
    }







}
