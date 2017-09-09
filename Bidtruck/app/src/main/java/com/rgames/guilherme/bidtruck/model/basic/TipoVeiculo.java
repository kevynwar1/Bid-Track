package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

/**
 * Created by Guilherme on 09/09/2017.
 */

public class TipoVeiculo implements Parcelable{
    private int codigo;
    private Empresa empresa;
    private String descricao;
    private float peso;
    private char situacao;

    protected TipoVeiculo(Parcel in) {
        codigo = in.readInt();
        empresa = in.readParcelable(Empresa.class.getClassLoader());
        descricao = in.readString();
        peso = in.readFloat();
    }

    public static final Creator<TipoVeiculo> CREATOR = new Creator<TipoVeiculo>() {
        @Override
        public TipoVeiculo createFromParcel(Parcel in) {
            return new TipoVeiculo(in);
        }

        @Override
        public TipoVeiculo[] newArray(int size) {
            return new TipoVeiculo[size];
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
        parcel.writeFloat(peso);
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public Empresa getEmpresa() {
        return empresa;
    }

    public void setEmpresa(Empresa empresa) {
        this.empresa = empresa;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public float getPeso() {
        return peso;
    }

    public void setPeso(float peso) {
        this.peso = peso;
    }

    public char getSituacao() {
        return situacao;
    }

    public void setSituacao(char situacao) {
        this.situacao = situacao;
    }
}
