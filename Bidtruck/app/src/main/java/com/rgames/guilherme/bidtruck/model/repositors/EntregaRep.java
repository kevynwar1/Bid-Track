package com.rgames.guilherme.bidtruck.model.repositors;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

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
import com.rgames.guilherme.bidtruck.model.dao.database.ScriptSql;
import com.rgames.guilherme.bidtruck.model.dao.database.StatusEntregaTable;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.EntregaActivity;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by C. Eduardo on 30/10/2017.
 */

public class EntregaRep {//extends SQLiteOpenHelper {


    //private static final String NOME_BANCO = "tecnologia177_4";
    //private static final int VERSAO = 1;
    //private static final String TABELA = "entraga";


    private SQLiteDatabase conn;
    private EntregaTable entregaTable;
    private DestinatarioTable destinatarioTable;
    private RomaneioTable romaneioTable;
    private StatusEntregaTable statusEntregaTable;
    private DataBase banco;
    boolean success = false;



    public EntregaRep (Context context){
        //super(context, NOME_BANCO, null, VERSAO);
           banco = new DataBase(context);
    }



    /*@Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(ScriptSql.getCreateTableEntrega());

    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL(ScriptSql.getCreateTableEntrega());
        this.onCreate(db);

    }*/



    private ContentValues preencheEntrega( Entrega entrega, Romaneio romaneio) {
        ContentValues cv = new ContentValues();
        /*cv.put(entregaTable.COD_ROMANEIO, romaneio.getCodigo());
        cv.put(entregaTable.COD_DESTINATARIO, entrega.getDestinatario().getId());
        cv.put(entregaTable.COD_STATUS_ENTREGA, entrega.getStatusEntrega().getCodigo());
        cv.put(entregaTable.SEQ_ENTREGA,entrega.getSeq_entrega());
        cv.put(entregaTable.PESO_CARGA,entrega.getPeso());
        cv.put(entregaTable.NOTA_FISCAL,entrega.getNota_fiscal());*/
        // ContentValues cv = new ContentValues();

            cv.put(entregaTable.SEQ_ENTREGA, entrega.getSeq_entrega());
            cv.put(entregaTable.COD_ROMANEIO, romaneio.getCodigo());
            cv.put(entregaTable.NOTA_FISCAL, entrega.getNota_fiscal());
            cv.put(entregaTable.PESO_CARGA, entrega.getPeso());

            cv.put(entregaTable.RAZAO_SOCIAL_DESTINATARIO, entrega.getDestinatario().getRazao_social());
            cv.put(entregaTable.NOME_FANTASIA_DESTINATARIO, entrega.getDestinatario().getNome_fantasia());
            cv.put(entregaTable.COD_DESTINATARIO, entrega.getDestinatario().getId());

            cv.put(entregaTable.COD_STATUS_ENTREGA, entrega.getStatusEntrega().getCodigo());
            cv.put(entregaTable.DESCRICAO_STATUS, entrega.getStatusEntrega().getDescricao());

            cv.put(entregaTable.CNPJ, entrega.getDestinatario().getCpf_cnpj());
            cv.put(entregaTable.EMAIL, entrega.getDestinatario().getEmail());
            cv.put(entregaTable.TELEFONE, entrega.getDestinatario().getTelefone());
            cv.put(entregaTable.CEP, entrega.getDestinatario().getCEP());
            cv.put(entregaTable.UF, entrega.getDestinatario().getUF());
            cv.put(entregaTable.CIDADE, entrega.getDestinatario().getCidade());
            cv.put(entregaTable.BAIRRO, entrega.getDestinatario().getBairro());
            cv.put(entregaTable.LOGRADOURO, entrega.getDestinatario().getLogradouro());
            cv.put(entregaTable.NUMERO, entrega.getDestinatario().getNumero());
            cv.put(entregaTable.COMPLEMENTO, entrega.getDestinatario().getComplemento());
            cv.put(entregaTable.LATITUDE,entrega.getDestinatario().getLatitude());
            cv.put(entregaTable.LONGITUDE,entrega.getDestinatario().getLongitude());

        return cv;
    }

    public void inserirEntrega(Entrega entrega, Romaneio romaneio) {
        success = false;

        try{

           //SQLiteDatabase database = getWritableDatabase();
            SQLiteDatabase database = banco.getWritableDatabase();
              ContentValues cv = preencheEntrega(entrega, romaneio);
            long resultado = database.insertOrThrow(entregaTable.TABELA, null, cv);
            database.close();
            if(resultado != -1){
                success = true;
            }


            /*for(Entrega entrega : entregas){
                ContentValues cv = new ContentValues();
                cv.put(entregaTable.SEQ_ENTREGA,entrega.getSeq_entrega());
                cv.put(entregaTable.COD_ROMANEIO, romaneio.getCodigo());
                cv.put(entregaTable.NOTA_FISCAL,entrega.getNota_fiscal());
                cv.put(entregaTable.PESO_CARGA,entrega.getPeso());

                cv.put(entregaTable.RAZAO_SOCIAL_DESTINATARIO, entrega.getDestinatario().getRazao_social());
                cv.put(entregaTable.NOME_FANTASIA_DESTINATARIO, entrega.getDestinatario().getNome_fantasia());
                cv.put(entregaTable.COD_DESTINATARIO, entrega.getDestinatario().getId());

                cv.put(entregaTable.COD_STATUS_ENTREGA, entrega.getStatusEntrega().getCodigo());
                cv.put(entregaTable.DESCRICAO_STATUS, entrega.getStatusEntrega().getDescricao());

                cv.put(entregaTable.TELEFONE, entrega.getDestinatario().getTelefone());
                cv.put(entregaTable.CEP, entrega.getDestinatario().getCEP());
                cv.put(entregaTable.UF, entrega.getDestinatario().getUF());
                cv.put(entregaTable.CIDADE, entrega.getDestinatario().getCidade());
                cv.put(entregaTable.BAIRRO, entrega.getDestinatario().getBairro());
                cv.put(entregaTable.LOGRADOURO, entrega.getDestinatario().getLogradouro());
                cv.put(entregaTable.NUMERO, entrega.getDestinatario().getNumero());
                cv.put(entregaTable.COMPLEMENTO, entrega.getDestinatario().getComplemento());

                conn.insertOrThrow(entregaTable.TABELA, null, cv);
            }*/
            database.close();
            Log.i("Jesus", "Obrigado meu Pai");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }


    public long atualizaEntrega(Entrega entrega, Romaneio romaneio) {
        long resultado = 0;
        success = false;
        ContentValues cv = new ContentValues();
        cv.put(entregaTable.SEQ_ENTREGA, entrega.getSeq_entrega());
        cv.put(entregaTable.COD_ROMANEIO, romaneio.getCodigo());
        cv.put(entregaTable.NOTA_FISCAL, entrega.getNota_fiscal());
        cv.put(entregaTable.PESO_CARGA, entrega.getPeso());

        cv.put(entregaTable.RAZAO_SOCIAL_DESTINATARIO, entrega.getDestinatario().getRazao_social());
        cv.put(entregaTable.NOME_FANTASIA_DESTINATARIO, entrega.getDestinatario().getNome_fantasia());
        cv.put(entregaTable.COD_DESTINATARIO, entrega.getDestinatario().getId());

        cv.put(entregaTable.COD_STATUS_ENTREGA, entrega.getStatusEntrega().getCodigo());
        cv.put(entregaTable.DESCRICAO_STATUS, entrega.getStatusEntrega().getDescricao());

        cv.put(entregaTable.CNPJ, entrega.getDestinatario().getCpf_cnpj());
        cv.put(entregaTable.EMAIL, entrega.getDestinatario().getEmail());
        cv.put(entregaTable.TELEFONE, entrega.getDestinatario().getTelefone());
        cv.put(entregaTable.CEP, entrega.getDestinatario().getCEP());
        cv.put(entregaTable.UF, entrega.getDestinatario().getUF());
        cv.put(entregaTable.CIDADE, entrega.getDestinatario().getCidade());
        cv.put(entregaTable.BAIRRO, entrega.getDestinatario().getBairro());
        cv.put(entregaTable.LOGRADOURO, entrega.getDestinatario().getLogradouro());
        cv.put(entregaTable.NUMERO, entrega.getDestinatario().getNumero());
        cv.put(entregaTable.COMPLEMENTO, entrega.getDestinatario().getComplemento());
        cv.put(entregaTable.LATITUDE,entrega.getDestinatario().getLatitude());
        cv.put(entregaTable.LONGITUDE,entrega.getDestinatario().getLongitude());


        try {

            String[] args = {String.valueOf(entrega.getSeq_entrega()),
                             String.valueOf(romaneio.getCodigo())};
            SQLiteDatabase data = banco.getWritableDatabase();
            resultado = data.update(entregaTable.TABELA, cv, entregaTable.SEQ_ENTREGA + " = ?" + " and " + entregaTable.COD_ROMANEIO + " = ? ", args);
            data.close();

            if (resultado != -1) {
                success = true;
            }


        } catch (Exception e) {
            e.printStackTrace();
        }
        return resultado;

    }



    public List<Entrega> buscarEntrega() {
        SQLiteDatabase db = banco.getReadableDatabase();
        List<Entrega> entregasList = new ArrayList<Entrega>();
        //conn = banco.getReadableDatabase();
        try {
            String sql = "SELECT seq_entrega, nota_fiscal, peso_carga, telefone, cep, uf, cidade, bairro, cnpj, email, logradouro, numero, cod_destinatario, latitude, longitude, complemento, " +
                    "  nome_fantasia_destinatario, razao_social_destinatario, cod_status_entrega, descricao_status FROM " + entregaTable.TABELA;
            String[] argumentos = null;
            Cursor cursorEntrega = db.rawQuery(sql, argumentos);

            while (cursorEntrega.moveToNext()){
                Entrega entrega = new Entrega();
                Destinatario destiny = new Destinatario();
                StatusEntrega statusEntrega = new StatusEntrega();

                entrega.setSeq_entrega(cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.SEQ_ENTREGA)));
                entrega.setNota_fiscal(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.NOTA_FISCAL)));
                entrega.setPeso(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.PESO_CARGA)));

                destiny.setId(cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.COD_DESTINATARIO)));
                destiny.setBairro(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.BAIRRO)));
                destiny.setCEP(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.CNPJ)));
                destiny.setCEP(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.EMAIL)));
                destiny.setCEP(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.CEP)));
                destiny.setCidade(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.CIDADE)));
                destiny.setNumero(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.NUMERO)));
                destiny.setLogradouro(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.LOGRADOURO)));
                destiny.setNome_fantasia(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.NOME_FANTASIA_DESTINATARIO)));
                destiny.setRazao_social(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.RAZAO_SOCIAL_DESTINATARIO)));
                destiny.setUF(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.UF)));
                destiny.setTelefone(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.TELEFONE)));
              //destiny.setLatitude(cursorEntrega.getDouble(cursorEntrega.getColumnIndex(entregaTable.LATITUDE)));
                destiny.setLatitude(cursorEntrega.getDouble(cursorEntrega.getColumnIndex(entregaTable.LATITUDE)));
                destiny.setLongitude(cursorEntrega.getDouble(cursorEntrega.getColumnIndex(entregaTable.LONGITUDE)));
                //destiny.setLongitude(cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.LONGITUDE)));
                destiny.setComplemento(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.COMPLEMENTO)));

                statusEntrega.setCodigo(cursorEntrega.getInt(cursorEntrega.getColumnIndex(entregaTable.COD_STATUS_ENTREGA)));
                statusEntrega.setDescricao(cursorEntrega.getString(cursorEntrega.getColumnIndex(entregaTable.DESCRICAO_STATUS)));

                entrega.setDestinatario(destiny);
                entrega.setStatusEntrega(statusEntrega);

                entregasList.add(entrega);
            }
            Log.i("Gaara", "" + entregasList.size());
            cursorEntrega.close();
            db.close();
            /*
            if(cursorEntrega.getCount() > 0) {
                cursorEntrega.moveToFirst();
                do {
                    Entrega entrega = new Entrega();
                } while (cursorEntrega.moveToNext()) ;
                conn.close();
            }*/
        } catch (Exception e) {
            e.printStackTrace();
        }
        return entregasList;
    }


}