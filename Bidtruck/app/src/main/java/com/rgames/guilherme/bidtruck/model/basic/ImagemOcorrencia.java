package com.rgames.guilherme.bidtruck.model.basic;

import android.net.Uri;
import android.os.Parcel;
import android.os.Parcelable;

/**
 * Created by kevyn on 06/10/2017.
 */

public class ImagemOcorrencia implements Parcelable {

    private long _id;
    private Uri uri;
    private String imagePath;
    private boolean isPortraitImage;
    private byte[] foto;
    private Ocorrencia ocorrencia;

    public ImagemOcorrencia(long _id, Uri uri, String imagePath, byte[] foto, boolean isPortraitImage) {
        this._id = _id;
        this.uri = uri;
        this.imagePath = imagePath;
        this.foto = foto;
        this.isPortraitImage = isPortraitImage;
    }

    public ImagemOcorrencia(long _id, Uri uri, String imagePath, boolean isPortraitImage) {
        this._id = _id;
        this.uri = uri;
        this.imagePath = imagePath;
        this.isPortraitImage = isPortraitImage;

    }


    protected ImagemOcorrencia(Parcel in) {
        this._id = in.readLong();
        this.uri = in.readParcelable(Uri.class.getClassLoader());
        this.imagePath = in.readString();
        this.foto = new byte[in.readInt()];
        this.ocorrencia = in.readParcelable(Ocorrencia.class.getClassLoader());
        this.isPortraitImage = in.readByte() != 0;

    }

    public static final Creator<ImagemOcorrencia> CREATOR = new Creator<ImagemOcorrencia>() {
        @Override
        public ImagemOcorrencia createFromParcel(Parcel in) {
            return new ImagemOcorrencia(in);
        }

        @Override
        public ImagemOcorrencia[] newArray(int size) {
            return new ImagemOcorrencia[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeLong(this._id);
        dest.writeParcelable(this.uri, flags);
        dest.writeString(this.imagePath);
        dest.writeInt(foto.length);
        dest.writeByteArray(foto);
        dest.writeParcelable(this.ocorrencia, flags);
        dest.writeByte(this.isPortraitImage ? (byte) 1 : (byte) 0);
    }

    public Ocorrencia getOcorrencia() {
        return ocorrencia;
    }

    public void setOcorrencia(Ocorrencia ocorrencia) {
        this.ocorrencia = ocorrencia;
    }

    public long get_id() {
        return _id;
    }

    public void set_id(long _id) {
        this._id = _id;
    }

    public Uri getUri() {
        return uri;
    }

    public void setUri(Uri uri) {
        this.uri = uri;
    }

    public String getImagePath() {
        return imagePath;
    }

    public void setImagePath(String imagePath) {
        this.imagePath = imagePath;
    }

    public boolean isPortraitImage() {
        return isPortraitImage;
    }

    public void setPortraitImage(boolean portraitImage) {
        isPortraitImage = portraitImage;
    }

    public byte[] getFoto() {
        return foto;
    }

    public void setFoto(byte[] foto) {
        this.foto = foto;
    }
}
