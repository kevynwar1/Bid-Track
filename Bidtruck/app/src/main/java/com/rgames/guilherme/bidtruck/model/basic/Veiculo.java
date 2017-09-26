package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;
import android.util.Log;

/**
 * Created by Guilherme on 09/09/2017.
 */

public class Veiculo implements Parcelable {
    private int codigo;
    private Empresa empresa;
    private Motorista motorista;
    private TipoVeiculo tipo_veiculo;
    private String placa;
    private String chassi;
    private String proprio;
    private String capacidade;
    private String antt;
    private String situacao;

    public Veiculo() {
    }

    public Veiculo(int codigo, Empresa empresa, Motorista motorista, TipoVeiculo tipo_veiculo, String placa, String chassi, String proprio, String capacidade, String antt, String situacao) {
        this.codigo = codigo;
        this.empresa = empresa;
        this.motorista = motorista;
        this.tipo_veiculo = tipo_veiculo;
        this.placa = placa;
        this.chassi = chassi;
        this.proprio = proprio;
        this.capacidade = capacidade;
        this.antt = antt;
        this.situacao = situacao;
    }

    protected Veiculo(Parcel in) {
        codigo = in.readInt();
        empresa = in.readParcelable(Empresa.class.getClassLoader());
        motorista = in.readParcelable(Motorista.class.getClassLoader());
        tipo_veiculo = in.readParcelable(TipoVeiculo.class.getClassLoader());
        placa = in.readString();
        chassi = in.readString();
        proprio = in.readString();
        capacidade = in.readString();
        antt = in.readString();
        situacao = in.readString();
    }

    public static final Creator<Veiculo> CREATOR = new Creator<Veiculo>() {
        @Override
        public Veiculo createFromParcel(Parcel in) {
            return new Veiculo(in);
        }

        @Override
        public Veiculo[] newArray(int size) {
            return new Veiculo[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeParcelable(empresa, i);
        parcel.writeParcelable(motorista, i);
        parcel.writeParcelable(tipo_veiculo, i);
        parcel.writeString(placa);
        parcel.writeString(chassi);
        parcel.writeString(proprio);
        parcel.writeString(capacidade);
        parcel.writeString(antt);
        parcel.writeString(situacao);
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public Empresa getEmpresa() {
        return empresa;
    }

    public void setEmpresa(Empresa empresa) {
        this.empresa = empresa;
    }

    public Motorista getMotorista() {
        return motorista;
    }

    public void setMotorista(Motorista motorista) {
        this.motorista = motorista;
    }

    public TipoVeiculo getTipo_veiculo() {
        return tipo_veiculo;
    }

    public void setTipo_veiculo(TipoVeiculo tipo_veiculo) {
        this.tipo_veiculo = tipo_veiculo;
    }

    public String getPlaca() {
        return placa;
    }

    public void setPlaca(String placa) {
        this.placa = placa;
    }

    public String getChassi() {
        return chassi;
    }

    public void setChassi(String chassi) {
        this.chassi = chassi;
    }

    public String getProprio() {
        return proprio;
    }

    public void setProprio(String proprio) {
        this.proprio = proprio;
    }

    public String getCapacidade() {
        return capacidade;
    }

    public void setCapacidade(String capacidade) {
        this.capacidade = capacidade;
    }

    public String getAntt() {
        return antt;
    }

    public void setAntt(String antt) {
        this.antt = antt;
    }

    public String getSituacao() {
        return situacao;
    }

    public void setSituacao(String situacao) {
        this.situacao = situacao;
    }
}
