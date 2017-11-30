package com.rgames.guilherme.bidtruck.model.dao.database;

import android.database.Cursor;

import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.ObjectInput;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;

class SQLCursor {

    public static Ocorrencia ocorrencia(Cursor cursor, SQLTable table) {
        Ocorrencia ocorrencia = new Ocorrencia(
                cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_COD_EMPRESA))
                , cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_SEQ_ENTREGA))
                , cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_COD_ROMANEIO))
                , cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_COD_TIPO_OCORRENCIA))
                , cursor.getString(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_DESCRICAO)));
        ocorrencia.setSituation((char) cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_SITUACAO)));
        //n lembro pq diz isso aq
        ocorrencia.setcodigo(cursor.getInt(cursor.getColumnIndex(table.TB_TIPOCORRENCIA_COL_CODIGO)));
        ocorrencia.inseridoApi = cursor.getInt(cursor.getColumnIndex(table.TB_OCORRENCIA_COL_INSERIDO_API)) > 0;
        return ocorrencia;
    }

//    public static Foto foto(Cursor cursor, SQLTable table) {
//        Foto foto = new Foto(cursor.getString(cursor.getColumnIndex(table.TB_FOTO_COL_FOTO)));
//        foto.setCodigo(cursor.getInt(cursor.getColumnIndex(table.TB_FOTO_COL_CODIGO)));
//        Ocorrencia o = new Ocorrencia();
//        o.setcodigo(cursor.getInt(cursor.getColumnIndex(table.TB_FOTO_COL_COD_OCORRENCIA)));
//        foto.setOcorrencia(o);
//        return foto;
//    }

    public static TipoOcorrencia tipoOcorrencia(Cursor cursor, SQLTable table) {
        TipoOcorrencia tipoOcorrencia = new TipoOcorrencia();
        tipoOcorrencia.setCodigo(cursor.getInt(cursor.getColumnIndex(table.TB_TIPOCORRENCIA_COL_CODIGO)));
        Empresa empresa = new Empresa();
        empresa.setCodigo(cursor.getInt(cursor.getColumnIndex(table.TB_TIPOCORRENCIA_COL_COD_EMPRESA)));
        tipoOcorrencia.setEmpresa(empresa);
        tipoOcorrencia.setDescription(cursor.getString(cursor.getColumnIndex(table.TB_TIPOCORRENCIA_COL_DESCRICAO)));
        tipoOcorrencia.setSituation((char) cursor.getInt(cursor.getColumnIndex(table.TB_TIPOCORRENCIA_COL_COD_SITUACAO)));
        return tipoOcorrencia;
    }

    public static Image image(Cursor cursor, SQLTable table) {
        return new Image(
                cursor.getInt(cursor.getColumnIndex(table.TB_FOTO_COL_ID))
                , null
                , cursor.getString(cursor.getColumnIndex(table.TB_FOTO_COL_FOTO))
                , cursor.getInt(cursor.getColumnIndex(table.TB_FOTO_COL_ISPORTRAIT)) > 0
        );
    }

    public static Object get(Object object, Cursor cursor, SQLTable table) {
        if (object instanceof Ocorrencia)
            return ocorrencia(cursor, table);
//        if (object instanceof Foto)
//            return foto(cursor, table);
        if (object instanceof Image)
            return image(cursor, table);
        if (object instanceof TipoOcorrencia)
            return tipoOcorrencia(cursor, table);
        return null;
    }

    public static byte[] convertToByteArray(Object object) {
        ByteArrayOutputStream bos = new ByteArrayOutputStream();
        ObjectOutputStream oos = null;
        byte[] bytes = new byte[0];
        try {
            oos = new ObjectOutputStream(bos);
            oos.writeObject(object);
            bytes = bos.toByteArray();
            return bytes;
        } catch (IOException e) {
            e.printStackTrace();
        }
        return bytes;
    }

    public static Object convertByteArrayToObject(byte[] bytes) {
        ByteArrayInputStream bis = new ByteArrayInputStream(bytes);
        ObjectInput in;
        Object object = null;
        try {
            in = new ObjectInputStream(bis);
            object = in.readObject();
            in.close();
        } catch (IOException | ClassNotFoundException e) {
            e.printStackTrace();
        }
        return object;
    }
}
