package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import java.util.List;

public class StatusEntrega implements Parcelable {

    private int codigo;
    private Ocorrencia ocorrencia;
    private String descricao;
    private List<Entrega> entregaList;
    private String date;

    public StatusEntrega() {
    }

    public StatusEntrega(int codigo, List<Entrega> entregaList, Ocorrencia ocorrencia, String date, String descricao ) {
        this.codigo = codigo;
        this.ocorrencia = ocorrencia;
        this.entregaList = entregaList;
        this.date = date;
        this.setDescricao(descricao);

    }

    protected StatusEntrega(Parcel in) {
        codigo = in.readInt();
        ocorrencia = in.readParcelable(Ocorrencia.class.getClassLoader());
        //ta bugando, reolver dps error: Unmarshalling unknown type code 115 at offset 820
//        setEntregaList(new ArrayList<Entrega>());
//        in.readList(getEntregaList(), Entrega.class.getClassLoader());
        date = in.readString();
    }

    public static final Creator<StatusEntrega> CREATOR = new Creator<StatusEntrega>() {
        @Override
        public StatusEntrega createFromParcel(Parcel in) {
            return new StatusEntrega(in);
        }

        @Override
        public StatusEntrega[] newArray(int size) {
            return new StatusEntrega[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeParcelable(ocorrencia, i);
//        parcel.writeList(entregaList);
        parcel.writeString(date);
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public Ocorrencia getOcorrencia() {
        return ocorrencia;
    }

    public void setOcorrencia(Ocorrencia ocorrencia) {
        this.ocorrencia = ocorrencia;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public List<Entrega> getEntregaList() {
        return entregaList;
    }

    public void setEntregaList(List<Entrega> entregaList) {
        this.entregaList = entregaList;
    }


    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }
}
