package com.rgames.guilherme.bidtruck.controller;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.business.BusOcorrencia;
import com.rgames.guilherme.bidtruck.model.errors.EmpresaNullException;
import com.rgames.guilherme.bidtruck.model.errors.EntregaNullException;

import java.util.List;

/**
 * Created by Guilherme on 05/10/2017.
 */

public class ControllerOcorrencia {

    private BusOcorrencia busOcorrencia;

    public ControllerOcorrencia(){
        busOcorrencia = new BusOcorrencia();
    }

    public List<Ocorrencia> select(int seq_entrega, int romaneio) throws EntregaNullException{
        return busOcorrencia.select(seq_entrega, romaneio);
    }

    public boolean insert(Ocorrencia ocorrencia) throws Exception{
        return busOcorrencia.insert(ocorrencia);
    }

    public List<TipoOcorrencia> selectTipo(int empresa) throws EmpresaNullException{
        return busOcorrencia.selectTipo(empresa);
    }
}
