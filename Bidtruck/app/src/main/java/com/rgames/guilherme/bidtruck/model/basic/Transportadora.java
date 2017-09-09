package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;

/**
 * Created by Guilherme on 09/09/2017.
 */

public class Transportadora extends Base {

    private Empresa empresa;
    private String razao_social;
    private String nome_fantasia;
    private int cnpj;

    public Transportadora() {
    }

    protected Transportadora(Parcel in) {
        empresa = in.readParcelable(Empresa.class.getClassLoader());
        razao_social = in.readString();
        nome_fantasia = in.readString();
        cnpj = in.readInt();
    }

    public static final Creator<Transportadora> CREATOR = new Creator<Transportadora>() {
        @Override
        public Transportadora createFromParcel(Parcel in) {
            return new Transportadora(in);
        }

        @Override
        public Transportadora[] newArray(int size) {
            return new Transportadora[size];
        }
    };

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeParcelable(empresa, i);
        parcel.writeString(razao_social);
        parcel.writeString(nome_fantasia);
        parcel.writeInt(cnpj);
    }

    @Override
    public int describeContents() {
        return 0;
    }

    public Empresa getEmpresa() {
        return empresa;
    }

    public void setEmpresa(Empresa empresa) {
        this.empresa = empresa;
    }

    public String getRazao_social() {
        return razao_social;
    }

    public void setRazao_social(String razao_social) {
        this.razao_social = razao_social;
    }

    public int getCnpj() {
        return cnpj;
    }

    public void setCnpj(int cnpj) {
        this.cnpj = cnpj;
    }
}
