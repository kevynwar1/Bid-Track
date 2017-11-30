package com.rgames.guilherme.bidtruck.controller;

import android.content.Context;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.business.BusOcorrencia;
import com.rgames.guilherme.bidtruck.model.errors.EmpresaNullException;
import com.rgames.guilherme.bidtruck.model.errors.EntregaNullException;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;

import java.util.ArrayList;
import java.util.List;


public class ControllerOcorrencia {

    private BusOcorrencia busOcorrencia;

    public ControllerOcorrencia(Context context) {
        busOcorrencia = new BusOcorrencia(context);
    }

    public List<Ocorrencia> select(int seq_entrega, int romaneio) throws EntregaNullException {
        return busOcorrencia.select(seq_entrega, romaneio);
    }

    public List<TipoOcorrencia> selectTipo(int empresa) throws EmpresaNullException {
        return busOcorrencia.selectTipo(empresa);
    }

    public boolean insert(Ocorrencia ocorrencia, List<Image> fotos) {
        return busOcorrencia.insert(ocorrencia, fotos);
    }

    public void insertOff(Ocorrencia ocorrencia, List<Image> fotos) {
        busOcorrencia.insertNoAndroid(ocorrencia, fotos);
    }

    public long insertTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        return busOcorrencia.insertTipoOcorrencia(tipoOcorrencia);
    }

    public int updateTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        return busOcorrencia.updateTipoOcorrencia(tipoOcorrencia);
    }

    public int updateOcorrencia(Ocorrencia ocorrencia) {
        return busOcorrencia.updateOcorrencia(ocorrencia);
    }

    public int updateListaDeFotos(Ocorrencia ocorrencia, ArrayList<Image> fotos) {
        return busOcorrencia.updateListaDeFotos(fotos, ocorrencia);
    }

    public boolean deleteOcorrencia(Ocorrencia ocorrencia) {
        return busOcorrencia.deleteOcorrencia(ocorrencia);
    }

    public int deleteTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        return busOcorrencia.deleteTipoOcorrencia(tipoOcorrencia);
    }
    public int deleteOcorrenciaTodos() {
        return busOcorrencia.deleteOcorrenciaTodos();
    }

    public int deleteTipoOcorrenciaTodos() {
        return busOcorrencia.deleteTipoOcorrenciaTodos();
    }
}
