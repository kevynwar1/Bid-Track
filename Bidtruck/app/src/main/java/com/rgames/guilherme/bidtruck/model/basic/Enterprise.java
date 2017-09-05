package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

/**
 * Created by Guilherme on 05/09/2017.
 */

public class Enterprise implements Parcelable {

    private String razao_social;

    public Enterprise() {}

    public Enterprise(String razao_social) {
        this.razao_social = razao_social;
    }

    protected Enterprise(Parcel in) {
        razao_social = in.readString();
    }

    public static final Creator<Enterprise> CREATOR = new Creator<Enterprise>() {
        @Override
        public Enterprise createFromParcel(Parcel in) {
            return new Enterprise(in);
        }

        @Override
        public Enterprise[] newArray(int size) {
            return new Enterprise[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeString(razao_social);
    }

    public String getRazao_social() {
        return razao_social;
    }

    public void setRazao_social(String razao_social) {
        this.razao_social = razao_social;
    }
}
