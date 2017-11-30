package com.rgames.guilherme.bidtruck.model.dao.database;

import android.content.ContentValues;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;

class SQLContentValues {

    static ContentValues ocorrencia(Ocorrencia ocorrencia, SQLTable table) {
        ContentValues contentValues = new ContentValues();
        contentValues.put(table.TB_OCORRENCIA_COL_COD_EMPRESA, ocorrencia.getEmpresa().getCodigo());
        contentValues.put(table.TB_OCORRENCIA_COL_SEQ_ENTREGA, ocorrencia.getEntrega().getSeq_entrega());
        contentValues.put(table.TB_OCORRENCIA_COL_COD_ROMANEIO, ocorrencia.getRomaneio().getCodigo());
        contentValues.put(table.TB_OCORRENCIA_COL_COD_TIPO_OCORRENCIA, ocorrencia.getTipoOcorrencia().getCodigo());
        contentValues.put(table.TB_OCORRENCIA_COL_DESCRICAO, ocorrencia.getDescricao());
        contentValues.put(table.TB_OCORRENCIA_COL_SITUACAO, (int) ocorrencia.getSituation());
        contentValues.put(table.TB_OCORRENCIA_COL_INSERIDO_API, (ocorrencia.inseridoApi) ? 1 : 0);
        return contentValues;
    }

//    public static ContentValues foto(Foto foto, SQLTable table) {
//        ContentValues contentValues = new ContentValues();
//        contentValues.put(table.TB_FOTO_COL_FOTO, foto.getFoto());
//        contentValues.put(table.TB_FOTO_COL_COD_OCORRENCIA, foto.getOcorrencia().getCodigo());
//        return contentValues;
//    }

    public static ContentValues image(Image image, SQLTable table) {
        ContentValues contentValues = new ContentValues();
        contentValues.put(table.TB_FOTO_COL_FOTO, image.imagePath);
        contentValues.put(table.TB_FOTO_COL_ISPORTRAIT, image.isPortraitImage);
        contentValues.put(table.TB_FOTO_COL_COD_OCORRENCIA, image.ocorrencia.getCodigo());
        contentValues.put(table.TB_FOTO_COL_ID, image._id);
        return contentValues;
    }

    static ContentValues tipoOcorrencia(TipoOcorrencia tipoOcorrencia, SQLTable table) {
        ContentValues contentValues = new ContentValues();
        contentValues.put(table.TB_TIPOCORRENCIA_COL_CODIGO, tipoOcorrencia.getCodigo());
        contentValues.put(table.TB_TIPOCORRENCIA_COL_COD_EMPRESA, tipoOcorrencia.getEmpresa().getCodigo());
        contentValues.put(table.TB_TIPOCORRENCIA_COL_DESCRICAO, tipoOcorrencia.getDescription());
        contentValues.put(table.TB_TIPOCORRENCIA_COL_COD_SITUACAO, (int) tipoOcorrencia.getSituation());
        return contentValues;
    }
}
