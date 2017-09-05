package com.rgames.guilherme.bidtruck.model.basic;

import android.icu.util.Calendar;
import android.os.Build;
import android.os.Parcel;
import android.os.Parcelable;

import java.util.ArrayList;
import java.util.List;

public class StatusDelivery implements Parcelable {

    private int id;
    private Occurrence occurrence;
    private List<Delivery> deliveryList;
    private Calendar date;

    public StatusDelivery() {
    }

    public StatusDelivery(int id, List<Delivery> deliveryList, Occurrence occurrence, Calendar date) {
        this.id = id;
        this.occurrence = occurrence;
        this.deliveryList = deliveryList;
        this.date = date;
    }

    protected StatusDelivery(Parcel in) {
        id = in.readInt();
        occurrence = in.readParcelable(Occurrence.class.getClassLoader());
        //ta bugando, reolver dps error: Unmarshalling unknown type code 115 at offset 820
//        setDeliveryList(new ArrayList<Delivery>());
//        in.readList(getDeliveryList(), Delivery.class.getClassLoader());
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
            date = (Calendar) in.readSerializable();
        }
    }

    public static final Creator<StatusDelivery> CREATOR = new Creator<StatusDelivery>() {
        @Override
        public StatusDelivery createFromParcel(Parcel in) {
            return new StatusDelivery(in);
        }

        @Override
        public StatusDelivery[] newArray(int size) {
            return new StatusDelivery[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(id);
        parcel.writeParcelable(occurrence, i);
//        parcel.writeList(deliveryList);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
            //Requer a api na versao 24
            //usar o getMilles tbm requer a 24
            parcel.writeSerializable(date);
        }
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Occurrence getOccurrence() {
        return occurrence;
    }

    public void setOccurrence(Occurrence occurrence) {
        this.occurrence = occurrence;
    }

    public Calendar getDate() {
        return date;
    }

    public void setDate(Calendar date) {
        this.date = date;
    }

    public List<Delivery> getDeliveryList() {
        return deliveryList;
    }

    public void setDeliveryList(List<Delivery> deliveryList) {
        this.deliveryList = deliveryList;
    }
}
