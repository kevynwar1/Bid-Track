package com.rgames.guilherme.bidtruck.model.dao.database;

import android.content.Context;
import android.database.Cursor;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;

import java.util.ArrayList;
import java.util.List;

public class DAOOcorrencia extends DAOGeneric {

    private SQLTable table;

    public DAOOcorrencia(Context context) {
        super(context);
        table = new SQLTable();
    }

    public long insert(Ocorrencia ocorrencia) {
        db = base.getWritableDatabase();
        long id = super.insert(table.TB_OCORRENCIA, SQLContentValues.ocorrencia(ocorrencia, table));
        db.close();
        return id;
    }

    public long insertTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        db = base.getWritableDatabase();
        long id = super.insert(table.TB_TIPOCORRENCIA, SQLContentValues.tipoOcorrencia(tipoOcorrencia, table));
        db.close();
        return id;
    }

    public boolean insertListaDeFotos(List<Image> fotos) {
        try {
            db = base.getWritableDatabase();
            db.beginTransaction();
            for (Image foto : fotos) {
                super.insert(table.TB_FOTO, SQLContentValues.image(foto, table));
            }
            db.setTransactionSuccessful();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (db != null) {
                db.endTransaction();
                db.close();
            }
        }
        return false;
    }

    public int update(Ocorrencia ocorrencia) {
        db = base.getWritableDatabase();
        int affec = super.update(table.TB_OCORRENCIA, table.TB_FOTO_COL_CODIGO + " = ? "
                , SQLContentValues.ocorrencia(ocorrencia, table), ocorrencia.getCodigo());
        db.close();
        return affec;
    }

    public int updateTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        db = base.getWritableDatabase();
        int affect = super.update(table.TB_TIPOCORRENCIA, table.TB_TIPOCORRENCIA_COL_CODIGO + " = ? "
                , SQLContentValues.tipoOcorrencia(tipoOcorrencia, table), tipoOcorrencia.getCodigo());
        db.close();
        return affect;
    }

    public int updateListaDeFotos(ArrayList<Image> fotoList) {
        int affectedRows = 0;
        try {
            db = base.getWritableDatabase();
            db.beginTransaction();
            for (Image foto : fotoList) {
                affectedRows += super.update(table.TB_FOTO, table.TB_FOTO_COL_CODIGO + " = ? "
                        , SQLContentValues.image(foto, table), (int) foto._id);
            }
            db.setTransactionSuccessful();
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (db != null) {
                db.endTransaction();
                db.close();
            }
        }
        return affectedRows;
    }

    public boolean delete(Ocorrencia ocorrencia) {
        try {
            db = super.base.getReadableDatabase();
            db.beginTransaction();
            if (super.delete(table.TB_OCORRENCIA, table.TB_OCORRENCIA_COL_CODIGO + " = ? ", ocorrencia.getCodigo()) > 0) {
                if (super.delete(table.TB_FOTO, table.TB_FOTO_COL_COD_OCORRENCIA + " = ? ", ocorrencia.getCodigo()) == 0)
                    return false;
                else
                    db.setTransactionSuccessful();
            } else return false;
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (db != null) {
                db.endTransaction();
                db.close();
            }
        }
        return false;
    }

    public int deleteTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        db = base.getWritableDatabase();
        int affec = super.delete(table.TB_TIPOCORRENCIA, table.TB_TIPOCORRENCIA_COL_CODIGO, tipoOcorrencia.getCodigo());
        db.close();
        return affec;
    }

    public int deleteTipoOcorrenciaTodos() {
        db = base.getWritableDatabase();
        int aff = db.delete(table.TB_TIPOCORRENCIA, null, null);
        db.close();
        return aff;
    }

    public int deleteOcorrenciaTodos() {
        db = base.getWritableDatabase();
        int aff = db.delete(table.TB_OCORRENCIA, null, null);
        db.close();
        return aff;
    }

    /**
     * CAGA PRO CODIGO!!!!!! FAZ!!!
     */
    public List<Ocorrencia> select(int seq_entrega, int romaneio) {
        db = super.base.getReadableDatabase();
        List<Image> listaFotos = new ArrayList<>();
        List<Ocorrencia> listaOcorrencia = new ArrayList<>();
        List<Object> objs;
        try {
            Cursor cursor = db.rawQuery(
                    "SELECT * FROM " + table.TB_OCORRENCIA + " WHERE "
                            + table.TB_OCORRENCIA_COL_SEQ_ENTREGA + " = ? AND "
                            + table.TB_OCORRENCIA_COL_COD_ROMANEIO + " = ?"
                    , new String[]{String.valueOf(seq_entrega), String.valueOf(romaneio)});
            Ocorrencia ocorrencia;
            while (cursor.moveToNext()) {
                ocorrencia = SQLCursor.ocorrencia(cursor, table);
                objs = super.select(
                        "SELECT * FROM " + table.TB_FOTO +
                                " WHERE " + table.TB_FOTO_COL_COD_OCORRENCIA + " = ?;"
                        , new Image()
                        , table
                        , new String[]{String.valueOf(ocorrencia.getCodigo())});

                for (Object o : objs)
                    if (o instanceof Image)
                        listaFotos.add((Image) o);
                ocorrencia.setFotos(listaFotos);

                Cursor cursorTipo = db.rawQuery("SELECT * FROM " + table.TB_TIPOCORRENCIA + " WHERE "
                                + table.TB_TIPOCORRENCIA_COL_CODIGO + " = ?"
                        , new String[]{String.valueOf(ocorrencia.getTipoOcorrencia().getCodigo())
                        });
                if (cursorTipo.moveToNext()) {
                    TipoOcorrencia tipoOcorrencia = SQLCursor.tipoOcorrencia(cursorTipo, table);
                    ocorrencia.setTipoOcorrencia(tipoOcorrencia);
                    cursorTipo.close();
                } else Log.i("teste", "n existe");
                listaOcorrencia.add(ocorrencia);
            }
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (db != null)
                db.close();
        }
        return listaOcorrencia;
    }


    public List<TipoOcorrencia> selectTipoOcorrencia(int idEntrega) {
        List<TipoOcorrencia> tipoOcorrenciaList = new ArrayList<>();
        db = base.getReadableDatabase();
        List<Object> list = super.select(
                "SELECT * FROM " + table.TB_TIPOCORRENCIA
                        + " WHERE " + table.TB_TIPOCORRENCIA_COL_COD_EMPRESA + " = ?"
                , new TipoOcorrencia()
                , table
                , new String[]{String.valueOf(idEntrega)});
        for (Object o : list) {
            if (o instanceof TipoOcorrencia)
                tipoOcorrenciaList.add((TipoOcorrencia) o);
        }
        db.close();
        return tipoOcorrenciaList;
    }
}
