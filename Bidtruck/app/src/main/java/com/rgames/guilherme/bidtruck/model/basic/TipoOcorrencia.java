package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

public class TipoOcorrencia implements Parcelable {

    private int codigo;
    private String description;
    private char situation;

    public TipoOcorrencia(int codigo, String description, char situation) {
        this.codigo = codigo;
        this.description = description;
        this.situation = situation;
    }

    protected TipoOcorrencia(Parcel in) {
        codigo = in.readInt();
        description = in.readString();
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
        parcel.writeString(description);
        parcel.writeCharArray(new char[]{situation});
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
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
}
