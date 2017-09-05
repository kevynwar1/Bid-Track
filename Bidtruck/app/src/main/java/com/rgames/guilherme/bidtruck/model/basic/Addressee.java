package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

/**
 * Classe do destinátio.
 * */
public class Addressee implements Parcelable {

    private int id;
    private Delivery delivery;
    private Company company;


    public Addressee(){}
    public Addressee(int id) {
        this.id = id;
    }

    protected Addressee(Parcel in) {
        id = in.readInt();
    }

    public static final Creator<Addressee> CREATOR = new Creator<Addressee>() {
        @Override
        public Addressee createFromParcel(Parcel in) {
            return new Addressee(in);
        }

        @Override
        public Addressee[] newArray(int size) {
            return new Addressee[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(id);
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
}
