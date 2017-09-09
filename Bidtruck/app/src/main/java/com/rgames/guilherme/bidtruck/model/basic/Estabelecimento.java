package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;

public class Estabelecimento extends Base {

    private Empresa empresa;
    private String razao_social;
    private int cnpj;

    public Estabelecimento(){}

    protected Estabelecimento(Parcel in){
        super(in);
        empresa = in.readParcelable(Empresa.class.getClassLoader());
        razao_social = in.readString();
        cnpj = in.readInt();
    }

    public static final Creator<Estabelecimento> CREATOR = new Creator<Estabelecimento>() {
        @Override
        public Estabelecimento createFromParcel(Parcel in) {
            return new Estabelecimento(in);
        }

        @Override
        public Estabelecimento[] newArray(int size) {
            return new Estabelecimento[size];
        }
    };

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        super.writeToParcel(parcel, i);
        parcel.writeParcelable(empresa, i);
        parcel.writeString(razao_social);
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
