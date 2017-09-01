package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

public class Occurrence implements Parcelable {

    private int id;
    private TypeOccurrence typeOccurrence;
    private String description;
    private char situation;

    public Occurrence(int id, TypeOccurrence typeOccurrence, String description, char situation) {
        this.id = id;
        this.typeOccurrence = typeOccurrence;
        this.description = description;
        this.situation = situation;
    }

    protected Occurrence(Parcel in) {
        id = in.readInt();
        typeOccurrence = in.readParcelable(TypeOccurrence.class.getClassLoader());
        description = in.readString();
        //situation = in.writeCharArray(new char[]);
    }

    public static final Creator<Occurrence> CREATOR = new Creator<Occurrence>() {
        @Override
        public Occurrence createFromParcel(Parcel in) {
            return new Occurrence(in);
        }

        @Override
        public Occurrence[] newArray(int size) {
            return new Occurrence[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(id);
        parcel.writeParcelable(typeOccurrence, i);
        parcel.writeString(description);
        parcel.writeCharArray(new char[]{situation});
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public TypeOccurrence getTypeOccurrence() {
        return typeOccurrence;
    }

    public void setTypeOccurrence(TypeOccurrence typeOccurrence) {
        this.typeOccurrence = typeOccurrence;
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
