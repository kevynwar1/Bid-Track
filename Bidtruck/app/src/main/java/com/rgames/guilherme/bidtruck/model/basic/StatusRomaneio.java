package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

public class StatusRomaneio implements Parcelable {
    private int codigo;
    private String descricao;
    private char situacao;

    public StatusRomaneio(){}

    protected StatusRomaneio(Parcel in) {
        codigo = in.readInt();
        descricao = in.readString();
    }

    public static final Creator<StatusRomaneio> CREATOR = new Creator<StatusRomaneio>() {
        @Override
        public StatusRomaneio createFromParcel(Parcel in) {
            return new StatusRomaneio(in);
        }

        @Override
        public StatusRomaneio[] newArray(int size) {
            return new StatusRomaneio[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeString(descricao);
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public char getSituacao() {
        return situacao;
    }

    public void setSituacao(char situacao) {
        this.situacao = situacao;
    }
}
