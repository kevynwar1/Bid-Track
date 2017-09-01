package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

public class TypeOccurrence implements Parcelable {

    private int id;
    private String description;
    private char situation;

    public TypeOccurrence(int id, String description, char situation) {
        this.id = id;
        this.description = description;
        this.situation = situation;
    }

    protected TypeOccurrence(Parcel in) {
        id = in.readInt();
        description = in.readString();
        //situation
    }

    public static final Creator<TypeOccurrence> CREATOR = new Creator<TypeOccurrence>() {
        @Override
        public TypeOccurrence createFromParcel(Parcel in) {
            return new TypeOccurrence(in);
        }

        @Override
        public TypeOccurrence[] newArray(int size) {
            return new TypeOccurrence[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(id);
        parcel.writeString(description);
        parcel.writeCharArray(new char[]{situation});
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
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
