package com.rgames.guilherme.bidtruck.view.fotos.utils;

import android.net.Uri;
import android.os.Parcel;
import android.os.Parcelable;

import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;

/**
 * Created by vansikrishna on 08/06/2016.
 */
public class Image implements Parcelable {

    public long _id;
    public Uri uri;
    private String imagePath;
    public boolean isPortraitImage;
    public Ocorrencia ocorrencia;

    public Image(){}

    public Image(long _id, Uri uri, String imagePath, boolean isPortraitImage) {
        this._id = _id;
        this.uri = uri;
        this.imagePath = imagePath;
        this.isPortraitImage = isPortraitImage;
    }

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeLong(this._id);
        dest.writeParcelable(this.uri, flags);
        dest.writeString(this.imagePath);
        dest.writeByte(this.isPortraitImage ? (byte) 1 : (byte) 0);
    }

    protected Image(Parcel in) {
        this._id = in.readLong();
        this.uri = in.readParcelable(Uri.class.getClassLoader());
        this.imagePath = in.readString();
        this.isPortraitImage = in.readByte() != 0;
    }

    public static final Creator<Image> CREATOR = new Creator<Image>() {
        @Override
        public Image createFromParcel(Parcel source) {
            return new Image(source);
        }

        @Override
        public Image[] newArray(int size) {
            return new Image[size];
        }
    };

    public String getImagePath() {
        return imagePath;
    }

    public void setImagePath(String imagePath) {
        this.imagePath = imagePath;
    }
}
