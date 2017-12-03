package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;

public class Romaneio implements Parcelable {

    public static final String PARCEL = "parcel_romaneiro";
    private int codigo;
    private int codigo_empresa;//Não deveria, mas foi necessario
    private Estabelecimento estabelecimento;
    private Motorista motorista;
    private List<Entrega> entregaList;
    private StatusRomaneio status_romaneio;
    private Veiculo veiculo;
    private String date_create;
    private String date_finalization;
    private String data_oferta;
    //private boolean ofertar_viagem;
    private char finalized;
    private boolean situation;
    private double valor;

    public double getValor() {
        return valor;
    }

    public void setValor(double valor) {
        this.valor = valor;
    }


    public Romaneio() {
    }


    @Override
    public String toString() {
        return new StringBuilder("Romaneio: ").append(codigo)
                .append(" Estabelecimento: ").append(getEstabelecimento().getCodigo())
                .append(" Motorista: ").append(getMotorista().getCodigo())
                .append(" Qtd de entregas: ").append((entregaList != null) ? entregaList.size() : "null")
                .append(" Status do romaneio: ").append(getStatus_romaneio().getCodigo()).toString();
                //.append(" Ofertar? ").append(isOfertar_viagem()).toString();
    }

    public Romaneio(int id, Estabelecimento estabelecimento, Motorista motorista, List<Entrega> entregaList, Veiculo veiculo, StatusRomaneio statusRomaneio, String date_create, String date_finalization, boolean ofertar_viagem, char finalized, boolean situation, int codigo_empresa) {
        this.codigo = id;
        this.estabelecimento = estabelecimento;
        this.motorista = motorista;
        this.entregaList = entregaList;
        this.veiculo = veiculo;
        this.codigo_empresa = codigo_empresa;
        this.status_romaneio = statusRomaneio;
        this.date_create = date_create;
        this.date_finalization = date_finalization;
       // this.ofertar_viagem = ofertar_viagem;
        this.situation = situation;
        this.finalized = finalized;
    }





    protected Romaneio(Parcel in) {
        codigo = in.readInt();
        codigo_empresa = in.readInt();
        //estabelecimento = in.readParcelable(Estabelecimento.class.getClassLoader());
        estabelecimento = Estabelecimento.CREATOR.createFromParcel(in);
        //motorista = in.readParcelable(Motorista.class.getClassLoader());
        motorista = Motorista.CREATOR.createFromParcel(in);
        //status_romaneio = in.readParcelable(StatusRomaneio.class.getClassLoader());
        status_romaneio = StatusRomaneio.CREATOR.createFromParcel(in);
//        veiculo = in.readParcelable(Veiculo.class.getClassLoader());
        date_create = in.readString();
        date_finalization = in.readString();
        data_oferta = in.readString();
        setEntregaList(new ArrayList<Entrega>());
        in.readList(getEntregaList(), Entrega.class.getClassLoader());
       // estabelecimento = in.readParcelable(Estabelecimento.class.getClassLoader());

       // ofertar_viagem = in.readByte() > 0;
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
        parcel.writeInt(codigo_empresa);
        parcel.writeParcelable(estabelecimento, i);
        parcel.writeParcelable(motorista, i);
        parcel.writeParcelable(status_romaneio, i);
//        parcel.writeParcelable(veiculo, i);
        parcel.writeString(date_create);
        parcel.writeString(date_finalization);
        parcel.writeString(data_oferta);
        parcel.writeList(entregaList);
      //  parcel.writeParcelable(estabelecimento, i);
      //  parcel.writeByte((byte) (ofertar_viagem ? 1 : 0));
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

   /* public boolean isOfertar_viagem() {
        return ofertar_viagem;
    }

    public void setOfertar_viagem(boolean ofertar_viagem) {
        this.ofertar_viagem = ofertar_viagem;
    }*/


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

    public StatusRomaneio getStatus_romaneio() {
        return status_romaneio;
    }

    public void setStatus_romaneio(StatusRomaneio status_romaneio) {
        this.status_romaneio = status_romaneio;
    }

    public Veiculo getVeiculo() {
        return veiculo;
    }

    public void setVeiculo(Veiculo veiculo) {
        this.veiculo = veiculo;
    }

    public String getDate_create() {
        return date_create;
    }

    public void setDate_create(String date_create) {
        this.date_create = date_create;
    }

    public String getDate_finalization() {
        return date_finalization;
    }

    public void setDate_finalization(String date_finalization) {
        this.date_finalization = date_finalization;
    }


    public int getCodigo_empresa() {
        return codigo_empresa;
    }

    public void setCodigo_empresa(int codigo_empresa) {
        this.codigo_empresa = codigo_empresa;
    }

    public String getData_oferta() {
        return data_oferta;
    }

    public void setData_oferta(String data_oferta) {
        this.data_oferta = data_oferta;
    }
}
