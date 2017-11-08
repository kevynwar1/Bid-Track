package com.rgames.guilherme.bidtruck.model.dao.database;

import android.content.ContentValues;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;

class SQLContentValues {

    public static ContentValues ocorrencia(Ocorrencia ocorrencia, SQLTable table) {
        ContentValues contentValues = new ContentValues();
        contentValues.put(table.TB_OCORRENCIA_COL_COD_EMPRESA, ocorrencia.getEmpresa().getCodigo());
        contentValues.put(table.TB_OCORRENCIA_COL_SEQ_ENTREGA, ocorrencia.getEntrega().getSeq_entrega());
        contentValues.put(table.TB_OCORRENCIA_COL_COD_ROMANEIO, ocorrencia.getRomaneio().getCodigo());
        contentValues.put(table.TB_OCORRENCIA_COL_COD_TIPO_OCORRENCIA, ocorrencia.getTipoOcorrencia().getCodigo());
        contentValues.put(table.TB_OCORRENCIA_COL_DESCRICAO, ocorrencia.getDescricao());
        contentValues.put(table.TB_OCORRENCIA_COL_SITUACAO, (int) ocorrencia.getSituation());
        return contentValues;
    }

//    public static ContentValues foto(Foto foto, SQLTable table){
//
//    }
}
