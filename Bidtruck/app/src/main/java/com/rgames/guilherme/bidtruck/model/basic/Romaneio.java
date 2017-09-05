package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import java.util.ArrayList;
import java.util.List;

public class Romaneio implements Parcelable {

    private int id;
    //transportadora
    //motorista
    private List<Delivery> deliveryList;
    private char finalized;
    private boolean situation;

    public Romaneio() {
    }

    public Romaneio(int id, List<Delivery> deliveryList, char finalized, boolean situation) {
        this.id = id;
        this.deliveryList = deliveryList;
        this.finalized = finalized;
        this.situation = situation;
    }

    protected Romaneio(Parcel in) {
        id = in.readInt();
        in.readList(getDeliveryList(), null);
        //finalized
        situation = in.readByte() > 0;
    }

    public static final Creator<Romaneio> CREATOR = new Creator<Romaneio>() {
        @Override
        public Romaneio createFromParcel(Parcel in) {
            return new Romaneio(in);
        }

        @Override
        public Romaneio[] newArray(int size) {
            return new Romaneio[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(id);
        parcel.writeList(deliveryList);
        //parcel.writeCharArray(new char[]{finalized});
        parcel.writeByte((byte) (situation ? 1 : 0));
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public char getFinalized() {
        return finalized;
    }

    public void setFinalized(char finalized) {
        this.finalized = finalized;
    }

    public boolean isSituation() {
        return situation;
    }

    public void setSituation(boolean situation) {
        this.situation = situation;
    }

    public List<Delivery> getDeliveryList() {
        return deliveryList;
    }

    public void setDeliveryList(List<Delivery> entregaList) {
        this.deliveryList = entregaList;
    }
}
