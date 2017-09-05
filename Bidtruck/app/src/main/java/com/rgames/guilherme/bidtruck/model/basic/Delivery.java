package com.rgames.guilherme.bidtruck.model.basic;

import android.graphics.Bitmap;
import android.os.Parcel;
import android.os.Parcelable;
import android.util.Log;

/**
 * Classe da entrega.
 */
public class Delivery implements Parcelable {

    public static final String PARCEL = "parcel_delivery";
    private int id;
    //    private int sequence_delivery;
//    private int NSF;
    private String titulo;
    private Romaneio romaneio;
    private Addressee addressee;
    private StatusDelivery statusDelivery;
    private float weight;
    private Bitmap image;
    private boolean situation;

    public Delivery() {
    }

    public Delivery(int id, String titulo, Romaneio romaneio, Addressee addressee, StatusDelivery statusDelivery, float weight, Bitmap image, boolean situation) {
        this.id = id;
        this.titulo = titulo;
        this.romaneio = romaneio;
        this.addressee = addressee;
        this.statusDelivery = statusDelivery;
        this.weight = weight;
        this.image = image;
        this.situation = situation;
    }

    protected Delivery(Parcel in) {
        id = in.readInt();
        titulo = in.readString();
        romaneio = in.readParcelable(Romaneio.class.getClassLoader());
        addressee = in.readParcelable(Addressee.class.getClassLoader());
        statusDelivery = in.readParcelable(StatusDelivery.class.getClassLoader());
        weight = in.readFloat();
        situation = in.readByte() > 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeInt(id);
        dest.writeString(titulo);
        dest.writeParcelable(romaneio, flags);
        dest.writeParcelable(addressee, flags);
        dest.writeParcelable(statusDelivery, flags);
        dest.writeFloat(weight);
        dest.writeByte((byte) (situation ? 1 : 0));
    }

    @Override
    public int describeContents() {
        return 0;
    }

    public static final Creator<Delivery> CREATOR = new Creator<Delivery>() {
        @Override
        public Delivery createFromParcel(Parcel in) {
            return new Delivery(in);
        }

        @Override
        public Delivery[] newArray(int size) {
            return new Delivery[size];
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

    public Romaneio getRomaneio() {
        return romaneio;
    }

    public void setRomaneio(Romaneio romaneio) {
        this.romaneio = romaneio;
    }

    public Addressee getAddressee() {
        return addressee;
    }

    public void setAddressee(Addressee addressee) {
        this.addressee = addressee;
    }

    public StatusDelivery getStatusDelivery() {
        return statusDelivery;
    }

    public void setStatusDelivery(StatusDelivery statusDelivery) {
        this.statusDelivery = statusDelivery;
    }

    public float getWeight() {
        return weight;
    }

    public void setWeight(float weight) {
        this.weight = weight;
    }

    public Bitmap getImage() {
        return image;
    }

    public void setImage(Bitmap image) {
        this.image = image;
    }

    public boolean isSituation() {
        return situation;
    }

    public void setSituation(boolean situation) {
        this.situation = situation;
    }
}
