package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import java.util.List;

public class Ocorrencia implements Parcelable {

    private int codigo;
    private List<StatusEntrega> statusEntregaList;
    private TipoOcorrencia tipoOcorrencia;
    private String description;
    private char situation;


    public Ocorrencia(int codigo, List<StatusEntrega> statusEntregaList, TipoOcorrencia tipoOcorrencia, String description, char situation) {
        this.codigo = codigo;
        this.statusEntregaList = statusEntregaList;
        this.tipoOcorrencia = tipoOcorrencia;
        this.description = description;
        this.situation = situation;
    }

    protected Ocorrencia(Parcel in) {
        codigo = in.readInt();
        in.readList(getStatusEntregaList(), null);
        tipoOcorrencia = in.readParcelable(TipoOcorrencia.class.getClassLoader());
        description = in.readString();
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

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeList(statusEntregaList);
        parcel.writeParcelable(tipoOcorrencia, i);
        parcel.writeString(description);
//        parcel.writeCharArray(new char[]{situation});
    }

    public int getcodigo() {
        return codigo;
    }

    public void setcodigo(int codigo) {
        this.codigo = codigo;
    }

    public TipoOcorrencia getTipoOcorrencia() {
        return tipoOcorrencia;
    }

    public void setTipoOcorrencia(TipoOcorrencia tipoOcorrencia) {
        this.tipoOcorrencia = tipoOcorrencia;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public char getSituation() {
        return situation;
    }

    public void setSituation(char situation) {
        this.situation = situation;
    }

    public List<StatusEntrega> getStatusEntregaList() {
        return statusEntregaList;
    }

    public void setStatusEntregaList(List<StatusEntrega> statusEntregaList) {
        this.statusEntregaList = statusEntregaList;
    }
}
