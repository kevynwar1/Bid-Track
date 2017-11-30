package com.rgames.guilherme.bidtruck.model.business;

import android.content.Context;
import android.util.Log;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.database.DAOOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpTipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.errors.EmpresaNullException;
import com.rgames.guilherme.bidtruck.model.errors.EntregaNullException;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;

import java.util.ArrayList;
import java.util.List;

public class BusOcorrencia {

    private HttpOcorrencia httpOcorrencia;
    private HttpTipoOcorrencia httpTipoOcorrencia;
    private DAOOcorrencia daoOcorrencia;
    private Context mContext;

    public BusOcorrencia(Context context) {
        httpOcorrencia = new HttpOcorrencia();
        httpTipoOcorrencia = new HttpTipoOcorrencia();
        daoOcorrencia = new DAOOcorrencia(context);
        mContext = context;
    }

    public List<Ocorrencia> select(int seq_entrega, int romaneio) throws EntregaNullException {
        if (HttpConnection.isConnected(mContext))
            if (seq_entrega == 0 || romaneio == 0) {
                throw new EntregaNullException();
            } else {
                deleteOcorrenciaTodos();
                List<Ocorrencia> list = httpOcorrencia.select(seq_entrega, romaneio);
                if (list != null)
                    for (Ocorrencia ocorrencia : list) {
                        ocorrencia.inseridoApi = true;
                        Log.i("teste", "inseriu oco");
                        insertNoAndroid(ocorrencia, null);
                    }
                return list;
            }
        return daoOcorrencia.select(seq_entrega, romaneio);
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

    public List<TipoOcorrencia> selectTipo(int empresa) throws EmpresaNullException {
        if (HttpConnection.isConnected(mContext)) {
            if (empresa == 0) throw new EmpresaNullException();
            return httpTipoOcorrencia.select(empresa);
        } else
            return daoOcorrencia.selectTipoOcorrencia(empresa);
    }

    public boolean insert(Ocorrencia ocorrencia, List<Image> fotos) {
        if (HttpConnection.isConnected(mContext)) {
            ArrayList<String> fotoString = new ArrayList<>();
            for (Image img : fotos) {
                fotoString.add(img.imagePath);
            }
            return httpOcorrencia.insert(ocorrencia, fotoString);
        } else {
            ocorrencia.inseridoApi = false;
            ocorrencia.setcodigo((int) daoOcorrencia.insert(ocorrencia));
            if (ocorrencia.getCodigo() > 0) {
                for (int i = 0; i < fotos.size(); i++) {
                    fotos.get(i).ocorrencia = ocorrencia;
                }
                return daoOcorrencia.insertListaDeFotos(fotos);
            }
        }
        return false;
    }

    public void insertNoAndroid(Ocorrencia ocorrencia, List<Image> fotos) {
        ocorrencia.setcodigo((int) daoOcorrencia.insert(ocorrencia));
        if (ocorrencia.getCodigo() > 0 && fotos != null) {
            for (int i = 0; i < fotos.size(); i++) {
                fotos.get(i).ocorrencia = ocorrencia;
            }
            daoOcorrencia.insertListaDeFotos(fotos);
        }
    }

    public long insertTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        return daoOcorrencia.insertTipoOcorrencia(tipoOcorrencia);
    }

    public int updateOcorrencia(Ocorrencia ocorrencia) {
        return daoOcorrencia.update(ocorrencia);
    }

    public int updateListaDeFotos(ArrayList<Image> fotos, Ocorrencia ocorrencia) {
        return daoOcorrencia.updateListaDeFotos(fotos);
    }

    public int updateTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        return daoOcorrencia.updateTipoOcorrencia(tipoOcorrencia);
    }

//    private ArrayList<Foto> getFotoList(ArrayList<String> fotos, Ocorrencia ocorrencia) {
//        ArrayList<Foto> lista = new ArrayList<>();
//        Foto ft;
//        for (String foto : fotos) {
//            ft = new Foto(foto);
//            ft.setOcorrencia(ocorrencia);
//            lista.add(ft);
//        }
//        return lista;
//    }

    public boolean deleteOcorrencia(Ocorrencia ocorrencia) {
        return daoOcorrencia.delete(ocorrencia);
    }

    public int deleteOcorrenciaTodos() {
        return daoOcorrencia.deleteOcorrenciaTodos();
    }

    public int deleteTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        return daoOcorrencia.deleteTipoOcorrencia(tipoOcorrencia);
    }

    public int deleteTipoOcorrenciaTodos() {
        return daoOcorrencia.deleteTipoOcorrenciaTodos();
    }
}
