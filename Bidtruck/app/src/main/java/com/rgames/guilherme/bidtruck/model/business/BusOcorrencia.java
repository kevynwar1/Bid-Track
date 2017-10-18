package com.rgames.guilherme.bidtruck.model.business;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpTipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.errors.EmpresaNullException;
import com.rgames.guilherme.bidtruck.model.errors.EntregaNullException;

import java.util.List;

/**
 * Created by Guilherme on 05/10/2017.
 */

public class BusOcorrencia {

    private HttpOcorrencia httpOcorrencia;
    private HttpTipoOcorrencia httpTipoOcorrencia;

    public BusOcorrencia() {
        httpOcorrencia = new HttpOcorrencia();
        httpTipoOcorrencia = new HttpTipoOcorrencia();
    }

    public List<Ocorrencia> select(int seq_entrega, int romaneio) throws EntregaNullException{
        //to afim de gerar outro retorno n
        if (seq_entrega == 0 || romaneio == 0)
            throw new EntregaNullException();
        return httpOcorrencia.select(seq_entrega, romaneio);
    }

 /*   public boolean insert(Ocorrencia ocorrencia) throws Exception{
        if(ocorrencia == null || ocorrencia.getEmpresa() == null || ocorrencia.getEntrega() == null || ocorrencia.getRomaneio() == null
                || ocorrencia.getTipoOcorrencia() == null)
            throw new NullPointerException("Erro ao tentar transmitir os dados ao servidor.");
        if(ocorrencia.getEmpresa().getCodigo() == 0)
            throw new EmpresaNullException();
        if(ocorrencia.getEntrega().getSeq_entrega() == 0 || ocorrencia.getRomaneio().getCodigo() == 0)
            throw new EntregaNullException();
        return httpOcorrencia.insert(ocorrencia);
    }*/

    public List<TipoOcorrencia> selectTipo(int empresa) throws EmpresaNullException{
        if (empresa == 0) throw new EmpresaNullException();
        return httpTipoOcorrencia.select(empresa);
    }
}
