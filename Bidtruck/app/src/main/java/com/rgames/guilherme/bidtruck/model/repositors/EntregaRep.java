package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.rgames.guilherme.bidtruck.model.basic.Destinatario;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Estabelecimento;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;
import com.rgames.guilherme.bidtruck.model.basic.StatusRomaneio;
import com.rgames.guilherme.bidtruck.model.dao.database.DataBase;
import com.rgames.guilherme.bidtruck.model.dao.database.DestinatarioTable;
import com.rgames.guilherme.bidtruck.model.dao.database.EntregaTable;
import com.rgames.guilherme.bidtruck.model.dao.database.RomaneioTable;
import com.rgames.guilherme.bidtruck.model.dao.database.StatusEntregaTable;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by C. Eduardo on 30/10/2017.
 */

public class EntregaRep {


    private SQLiteDatabase conn;
    private EntregaTable entregaTable;
    private DestinatarioTable destinatarioTable;
    private RomaneioTable romaneioTable;
    private StatusEntregaTable statusEntregaTable;
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


    public List<Entrega> buscarEntrega(int id_motorista) {
        //SQLiteDatabase db = banco.getReadableDatabase();
        conn = banco.getReadableDatabase();

        List<Entrega> entregasList = new ArrayList<Entrega>();
        try {
            String sql = "select e.seq_entrega, e.cod_romaneio, e.cod_destinatario, e.cod_status_entrega,e.peso_carga,e.nota_fiscal " +
                          " d.bairro,d.cep,d.cidade,d.logradouro,d.numero, d.nome_fantasia, d.razao_social, d.uf, d.telefone, s.codigo, s.descricao, d.latitude, d.longitude" +
                          " From " + entregaTable.TABELA + " as e Inner join " + romaneioTable.TABELA + " as r on e.cod_romaneio = r.codigo" +
                          " Inner join " + destinatarioTable.TABELA + "  as d on e.cod_destinatario = d.codigo " +
                          " Inner Join" + statusEntregaTable.TABELA + " as s on e.cod_status_entrega = s.codigo  WHERE r.cod_motorista = " + id_motorista;
            String[] argumentos = null;

            Cursor cursorEntrega = conn.rawQuery(sql, argumentos);


            if(cursorEntrega.getCount() > 0) {


                cursorEntrega.moveToFirst();

                do {

                        Entrega entrega = new Entrega();
                        Destinatario destiny = new Destinatario();
                        StatusEntrega statusEntrega = new StatusEntrega();

                    entrega.setCodigo(cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.SEQ_ENTREGA)));
                    entrega.setNota_fiscal(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.NOTA_FISCAL)));
                    entrega.setPeso(cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.PESO_CARGA)));
                    destiny.setId(cursorEntrega.getInt(cursorEntrega.getColumnIndex(destinatarioTable.CODIGO)));
                    destiny.setBairro(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.BAIRRO)));
                    destiny.setCEP(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.CEP)));
                    destiny.setCidade(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.CIDADE)));
                    destiny.setNumero(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.NUMERO)));
                    destiny.setLogradouro(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.LOGRADOURO)));
                    destiny.setNome_fantasia(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.NOME_FANTASIA)));
                    destiny.setRazao_social(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.RAZAO_SOCIAL)));
                    destiny.setUF(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.UF)));
                    destiny.setTelefone(cursorEntrega.getString(cursorEntrega.getColumnIndex(destinatarioTable.TELEFONE)));
                    destiny.setLatitude(cursorEntrega.getDouble(cursorEntrega.getColumnIndex(destinatarioTable.LATITUDE)));
                    destiny.setLongitude(cursorEntrega.getDouble(cursorEntrega.getColumnIndex(destinatarioTable.LONGITUDE)));

                    statusEntrega.setCodigo(cursorEntrega.getInt(cursorEntrega.getColumnIndex(statusEntregaTable.CODIGO)));
                    statusEntrega.setDescricao(cursorEntrega.getString(cursorEntrega.getColumnIndex(statusEntregaTable.DESCRICAO)));


                    entrega.setDestinatario(destiny);
                    entrega.setStatusEntrega(statusEntrega);


                    entregasList.add(entrega);


                    } while (cursorEntrega.moveToNext()) ;

                conn.close();
            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        return entregasList;
    }







}
