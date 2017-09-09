package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

public abstract class Base implements Parcelable{
    private int codigo;
    private String logradouro;
    private String numero;
    private String complemento;
    private String bairro;
    private String cidade;
    private String uf;
    private String cep;
    private String latitude;
    private String longitude;
    private String situacao;

    public Base(){

    }

    protected Base(Parcel in) {
        codigo = in.readInt();
        logradouro = in.readString();
        numero = in.readString();
        complemento = in.readString();
        bairro = in.readString();
        cidade = in.readString();
        uf = in.readString();
        cep = in.readString();
        latitude = in.readString();
        longitude = in.readString();
        situacao = in.readString();
    }

//    public static final Creator<Base> CREATOR = new Creator<Base>() {
//        @Override
//        public Base createFromParcel(Parcel in) {
//            return new Base(in);
//        }
//
//        @Override
//        public Base[] newArray(int size) {
//            return new Base[size];
//        }
//    };

//    @Override
//    public int describeContents() {
//        return 0;
//    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeString(logradouro);
        parcel.writeString(numero);
        parcel.writeString(complemento);
        parcel.writeString(bairro);
        parcel.writeString(cidade);
        parcel.writeString(uf);
        parcel.writeString(cep);
        parcel.writeString(latitude);
        parcel.writeString(longitude);
        parcel.writeString(situacao);
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getLogradouro() {
        return logradouro;
    }

    public void setLogradouro(String logradouro) {
        this.logradouro = logradouro;
    }

    public String getNumero() {
        return numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public String getComplemento() {
        return complemento;
    }

    public void setComplemento(String complemento) {
        this.complemento = complemento;
    }

    public String getBairro() {
        return bairro;
    }

    public void setBairro(String bairro) {
        this.bairro = bairro;
    }

    public String getCidade() {
        return cidade;
    }

    public void setCidade(String cidade) {
        this.cidade = cidade;
    }

    public String getUf() {
        return uf;
    }

    public void setUf(String uf) {
        this.uf = uf;
    }

    public String getCep() {
        return cep;
    }

    public void setCep(String cep) {
        this.cep = cep;
    }

    public String getLatitude() {
        return latitude;
    }

    public void setLatitude(String latitude) {
        this.latitude = latitude;
    }

    public String getLongitude() {
        return longitude;
    }

    public void setLongitude(String longitude) {
        this.longitude = longitude;
    }

    public String getSituacao() {
        return situacao;
    }

    public void setSituacao(String situacao) {
        this.situacao = situacao;
    }
}
