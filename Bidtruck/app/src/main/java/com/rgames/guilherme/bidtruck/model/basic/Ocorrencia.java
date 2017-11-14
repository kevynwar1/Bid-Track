package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;

import java.util.ArrayList;
import java.util.List;

public class Ocorrencia implements Parcelable {
    public static final String PARCEL = "ocorrencia";

    private int codigo;
    private Empresa empresa;
    private Entrega entrega;
    private Romaneio romaneio;
    private List<StatusEntrega> statusEntregaList;
    private TipoOcorrencia tipo_ocorrencia;
    private String descricao;
    private String data;
    private char situation;
    private List<Image> fotos;

    public Ocorrencia(){}

    public Ocorrencia(int empresa, int entrega, int romaneio, int tipo, String descricao) {
        setEmpresa(new Empresa());
        getEmpresa().setCodigo(empresa);
        setEntrega(new Entrega());
        getEntrega().setSeq_entrega(entrega);
        setRomaneio(new Romaneio());
        getRomaneio().setCodigo(romaneio);
        setTipoOcorrencia(new TipoOcorrencia());
        getTipoOcorrencia().setCodigo(tipo);
        setDescricao(descricao);
        fotos = new ArrayList<>();
    }

    public Ocorrencia(int codigo, List<StatusEntrega> statusEntregaList, TipoOcorrencia tipoOcorrencia, String description, char situation) {
        this.codigo = codigo;
        this.statusEntregaList = statusEntregaList;
        this.tipo_ocorrencia = tipoOcorrencia;
        this.descricao = description;
        this.situation = situation;
    }

    protected Ocorrencia(Parcel in) {
        codigo = in.readInt();
        in.readList(getStatusEntregaList(), null);
        empresa = in.readParcelable(Empresa.class.getClassLoader());
        entrega = in.readParcelable(Entrega.class.getClassLoader());
        romaneio = in.readParcelable(Romaneio.class.getClassLoader());
        tipo_ocorrencia = in.readParcelable(TipoOcorrencia.class.getClassLoader());
        descricao = in.readString();
        data = in.readString();
        //situation = in.writeCharArray(new char[]);
    }

    public static final Creator<Ocorrencia> CREATOR = new Creator<Ocorrencia>() {
        @Override
        public Ocorrencia createFromParcel(Parcel in) {
            return new Ocorrencia(in);
        }

        @Override
        public Ocorrencia[] newArray(int size) {
            return new Ocorrencia[size];
        }
    };

    public Ocorrencia(int idEmpresa, int seq_entrega, int romaneio, int codigoSelecionado, String descrip, ArrayList<String> listImagem) {

    }

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeList(statusEntregaList);
        parcel.writeParcelable(empresa, i);
        parcel.writeParcelable(entrega, i);
        parcel.writeParcelable(romaneio, i);
        parcel.writeParcelable(tipo_ocorrencia, i);
        parcel.writeString(descricao);
        parcel.writeString(data);
//        parcel.writeCharArray(new char[]{situation});
    }

    public int getCodigo() {
        return codigo;
    }

    public void setcodigo(int codigo) {
        this.codigo = codigo;
    }

    public Empresa getEmpresa() {
        return empresa;
    }

    public void setEmpresa(Empresa empresa) {
        this.empresa = empresa;
    }

    public Entrega getEntrega() {
        return entrega;
    }

    public void setEntrega(Entrega entrega) {
        this.entrega = entrega;
    }

    public Romaneio getRomaneio() {
        return romaneio;
    }

    public void setRomaneio(Romaneio romaneio) {
        this.romaneio = romaneio;
    }

    public TipoOcorrencia getTipoOcorrencia() {
        return tipo_ocorrencia;
    }

    public void setTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        this.tipo_ocorrencia = tipoOcorrencia;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String description) {
        this.descricao = description;
    }

    public char getSituation() {
        return situation;
    }

    public void setSituation(char situation) {
        this.situation = situation;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public List<StatusEntrega> getStatusEntregaList() {
        return statusEntregaList;
    }

    public void setStatusEntregaList(List<StatusEntrega> statusEntregaList) {
        this.statusEntregaList = statusEntregaList;
    }

    public List<Image> getFotos() {
        return fotos;
    }

    public void setFotos(List<Image> fotos) {
        this.fotos = fotos;
    }
}
