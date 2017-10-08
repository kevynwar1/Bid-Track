package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

public class TipoOcorrencia implements Parcelable {

    private int codigo;
    private Empresa empresa;
    private String descricao;
    private char situation;

    public TipoOcorrencia(){

    }

    public TipoOcorrencia(int codigo, Empresa empresa, String description, char situation) {
        this.codigo = codigo;
        this.empresa = empresa;
        this.descricao = description;
        this.situation = situation;
    }

    protected TipoOcorrencia(Parcel in) {
        codigo = in.readInt();
        empresa = in.readParcelable(Empresa.class.getClassLoader());
        descricao = in.readString();
        //situation
    }

    public static final Creator<TipoOcorrencia> CREATOR = new Creator<TipoOcorrencia>() {
        @Override
        public TipoOcorrencia createFromParcel(Parcel in) {
            return new TipoOcorrencia(in);
        }

        @Override
        public TipoOcorrencia[] newArray(int size) {
            return new TipoOcorrencia[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeParcelable(empresa, i);
        parcel.writeString(descricao);
        parcel.writeCharArray(new char[]{situation});
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getDescription() {
        return descricao;
    }

    public void setDescription(String description) {
        this.descricao = description;
    }

    public char getSituation() {
        return situation;
    }

    public void setSituation(char situation) {
        this.situation = situation;
    }

    public Empresa getEmpresa() {
        return empresa;
    }

    public void setEmpresa(Empresa empresa) {
        this.empresa = empresa;
    }
}
