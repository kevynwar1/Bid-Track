package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;


public class Empresa extends Base implements Parcelable {

    public static final String PARCEL_EMPRESA = "parcel_empresa";
    //private int codigo;
    private String razao_social;
    private String nome_fantasia;
    private String cnpj;
    private String foto;

    public Empresa() {
    }

    public Empresa(String razao_social) {
        this.razao_social = razao_social;
    }

    protected Empresa(Parcel in) {
        super(in);
        //codigo = in.readInt();
        razao_social = in.readString();
        nome_fantasia = in.readString();
        cnpj = in.readString();
        foto = in.readString();
    }

    public static final Creator<Empresa> CREATOR = new Creator<Empresa>() {
        @Override
        public Empresa createFromParcel(Parcel in) {
            return new Empresa(in);
        }

        @Override
        public Empresa[] newArray(int size) {
            return new Empresa[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        super.writeToParcel(parcel, i);
     // parcel.writeInt(cod_empresa);
        parcel.writeString(razao_social);
        parcel.writeString(nome_fantasia);
        parcel.writeString(cnpj);
        parcel.writeString(foto);
    }

    public String getRazao_social() {
        return razao_social;
    }

    public void setRazao_social(String razao_social) {
        this.razao_social = razao_social;
    }

    public String getNome_fantasia() {
        return nome_fantasia;
    }

    public void setNome_fantasia(String nome_fantasia) {
        this.nome_fantasia = nome_fantasia;
    }

    public String getCnpj() {
        return cnpj;
    }

    public void setCnpj(String cnpj) {
        this.cnpj = cnpj;
    }

    public String getFoto() {
        return foto;
    }

    public void setFoto(String foto) {
        this.foto = foto;
    }


   /* public int getCod_empresa() {
        return codigo;
    }

   public void setCod_empresa(int cod_empresa) {
        this.codigo = cod_empresa;
    }*/
}
