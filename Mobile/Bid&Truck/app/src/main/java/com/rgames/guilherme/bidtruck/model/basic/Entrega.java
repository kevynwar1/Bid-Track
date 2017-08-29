package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

/**
 * Created by Guilherme on 28/08/2017.
 */

public class Entrega implements Parcelable {

    private int id;
    private String titulo;
    public static final String PARCEL = "parcel";

    public Entrega(int id, String titulo) {
        this.id = id;
        this.titulo = titulo;
    }

    protected Entrega(Parcel in) {
        id = in.readInt();
        titulo = in.readString();
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeInt(id);
        dest.writeString(titulo);
    }

    @Override
    public int describeContents() {
        return 0;
    }

    public static final Creator<Entrega> CREATOR = new Creator<Entrega>() {
        @Override
        public Entrega createFromParcel(Parcel in) {
            return new Entrega(in);
        }

        @Override
        public Entrega[] newArray(int size) {
            return new Entrega[size];
        }
    };

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }
}
