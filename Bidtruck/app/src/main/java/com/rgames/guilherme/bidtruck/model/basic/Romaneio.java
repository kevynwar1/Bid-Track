package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import java.util.ArrayList;
import java.util.List;

public class Romaneio implements Parcelable {

    public static final String PARCEL = "parcel_romaneiro";
    private int codigo;
    private Estabelecimento estabelecimento;
    private Motorista motorista;
    private List<Entrega> entregaList;
    private StatusRomaneio status_romaneio;
    private Veiculo veiculo;
    //    private Calendar date_create;
    //    private Calendar date_finalization;
    private boolean ofertar_viagem;
    private char finalized;
    private boolean situation;

    public Romaneio() {
    }


    @Override
    public String toString() {
        return new StringBuilder("Romaneio: ").append(codigo)
                .append(" Estabelecimento: ").append(getEstabelecimento().getCodigo())
                .append(" Motorista: ").append(getMotorista().getCodigo())
                .append(" Qtd de entregas: ").append((entregaList != null) ? entregaList.size() : "null")
                .append(" Status do romaneio: ").append(getStatusRomaneio().getCodigo())
                .append(" Ofertar? ").append(isOfertar_viagem()).toString();
    }

    public Romaneio(int id, Estabelecimento estabelecimento, Motorista motorista, List<Entrega> entregaList, boolean ofertar_viagem, char finalized, boolean situation) {
        this.codigo = id;
        this.estabelecimento = estabelecimento;
        this.motorista = motorista;
        this.entregaList = entregaList;
        this.ofertar_viagem = ofertar_viagem;
        this.situation = situation;
        this.finalized = finalized;
    }

    protected Romaneio(Parcel in) {
        codigo = in.readInt();
        estabelecimento = in.readParcelable(Estabelecimento.class.getClassLoader());
        motorista = in.readParcelable(Motorista.class.getClassLoader());
        status_romaneio = in.readParcelable(StatusRomaneio.class.getClassLoader());
        setEntregaList(new ArrayList<Entrega>());
        in.readList(getEntregaList(), Entrega.class.getClassLoader());
        ofertar_viagem = in.readByte() > 0;
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
        parcel.writeInt(codigo);
        parcel.writeParcelable(estabelecimento, i);
        parcel.writeParcelable(motorista, i);
        parcel.writeParcelable(status_romaneio, i);
        parcel.writeList(entregaList);
        parcel.writeByte((byte) (ofertar_viagem ? 1 : 0));
        //parcel.writeCharArray(new char[]{finalized});
        parcel.writeByte((byte) (situation ? 1 : 0));
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public Estabelecimento getEstabelecimento() {
        return estabelecimento;
    }

    public void setEstabelecimento(Estabelecimento estabelecimento) {
        this.estabelecimento = estabelecimento;
    }

    public Motorista getMotorista() {
        return motorista;
    }

    public void setMotorista(Motorista motorista) {
        this.motorista = motorista;
    }

    public boolean isOfertar_viagem() {
        return ofertar_viagem;
    }

    public void setOfertar_viagem(boolean ofertar_viagem) {
        this.ofertar_viagem = ofertar_viagem;
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

    public List<Entrega> getEntregaList() {
        return entregaList;
    }

    public void setEntregaList(List<Entrega> entregaList) {
        this.entregaList = entregaList;
    }

    public StatusRomaneio getStatusRomaneio() {
        return status_romaneio;
    }

    public void setStatusRomaneio(StatusRomaneio statusRomaneio) {
        this.status_romaneio = statusRomaneio;
    }
}
