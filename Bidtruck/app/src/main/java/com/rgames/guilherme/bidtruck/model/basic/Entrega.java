package com.rgames.guilherme.bidtruck.model.basic;

import android.graphics.Bitmap;
import android.os.Parcel;
import android.os.Parcelable;

import java.io.Serializable;

/**
 * Classe da entrega.
 */
public class Entrega implements Parcelable, Serializable {

    public static final String PARCEL = "parcel_delivery";
    private int codigo;
    private int seq_entrega;
    private String nota_fiscal;
    private String titulo;
    // private Romaneio romaneio;
    private Destinatario destinatario;
    private StatusEntrega status_entrega;
    private float peso;
    private Bitmap image;
    private boolean situacao;

    public Entrega() {
    }

    public Entrega(int codigo, int seq_entrega, String nota_fiscal, String titulo, Destinatario destinatario, StatusEntrega status_entrega, float peso, Bitmap image, boolean situacao) {
        this.codigo = codigo;
        this.seq_entrega = seq_entrega;
        this.nota_fiscal = nota_fiscal;
        this.titulo = titulo;
//        this.romaneio = romaneio;
        this.destinatario = destinatario;
        this.status_entrega = status_entrega;
        this.peso = peso;
        this.image = image;
        this.situacao = situacao;
    }

    protected Entrega(Parcel in) {
        codigo = in.readInt();
        seq_entrega = in.readInt();
        nota_fiscal = in.readString();
        titulo = in.readString();
//        romaneio = in.readParcelable(Romaneio.class.getClassLoader());
        destinatario = in.readParcelable(Destinatario.class.getClassLoader());
        status_entrega = in.readParcelable(StatusEntrega.class.getClassLoader());
        peso = in.readFloat();
        situacao = in.readByte() > 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeInt(codigo);
        dest.writeInt(seq_entrega);
        dest.writeString(nota_fiscal);
        dest.writeString(titulo);
//        dest.writeParcelable(romaneio, flags);
        dest.writeParcelable(destinatario, flags);
        dest.writeParcelable(status_entrega, flags);
        dest.writeFloat(peso);
        dest.writeByte((byte) (situacao ? 1 : 0));
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

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public int getSeq_entrega() {
        return seq_entrega;
    }

    public void setSeq_entrega(int seq_entrega) {
        this.seq_entrega = seq_entrega;
    }

    public String getNota_fiscal() {
        return nota_fiscal;
    }

    public void setNota_fiscal(String nota_fiscal) {
        this.nota_fiscal = nota_fiscal;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }
//
//    public Romaneio getRomaneio() {
//        return romaneio;
//    }
//
//    public void setRomaneio(Romaneio romaneio) {
//        this.romaneio = romaneio;
//    }

    public Destinatario getDestinatario() {
        return destinatario;
    }

    public void setDestinatario(Destinatario destinatario) {
        this.destinatario = destinatario;
    }

    public StatusEntrega getStatusEntrega() {
        return status_entrega;
    }

    public void setStatusEntrega(StatusEntrega status_entrega) {
        this.status_entrega = status_entrega;
    }

    public float getPeso() {
        return peso;
    }

    public void setPeso(float peso) {
        this.peso = peso;
    }

    public Bitmap getImage() {
        return image;
    }

    public void setImage(Bitmap image) {
        this.image = image;
    }

    public boolean isSituacao() {
        return situacao;
    }

    public void setSituacao(boolean situacao) {
        this.situacao = situacao;
    }
}
