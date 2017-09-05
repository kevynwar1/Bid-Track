package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import java.util.ArrayList;
import java.util.List;

/**
 * Classe do destinátio.
 */
public class Addressee implements Parcelable {

    private int id;
    private List<Delivery> delivery;
    private Enterprise enterprise;
    private String razao_social;
    private String nome_fantasia;
    private char tipo_pessoa;
    private String cpf_cnpj;
    private String email;
    private String telefone;
    private String contato;
    private String CEP;
    private String UF;
    private String cidade;
    private String bairro;
    private String logradouro;
    private String numero;
    private String complemento;
    private double latitude;
    private double longitude;
    private boolean situacao;

    public Addressee() {
    }

    public Addressee(int id, List<Delivery> delivery, Enterprise enterprise, String razao_social, String nome_fantasia, char tipo_pessoa, String cpf_cnpj, String email, String telefone, String contato, String CEP, String UF, String cidade, String bairro, String logradouro, String numero, String complemento, double latitude, double longitude, boolean situacao) {
        this.id = id;
        this.delivery = delivery;
        this.enterprise = enterprise;
        this.razao_social = razao_social;
        this.nome_fantasia = nome_fantasia;
        this.tipo_pessoa = tipo_pessoa;
        this.cpf_cnpj = cpf_cnpj;
        this.email = email;
        this.telefone = telefone;
        this.contato = contato;
        this.CEP = CEP;
        this.UF = UF;
        this.cidade = cidade;
        this.bairro = bairro;
        this.logradouro = logradouro;
        this.numero = numero;
        this.complemento = complemento;
        this.latitude = latitude;
        this.longitude = longitude;
        this.situacao = situacao;
    }

    protected Addressee(Parcel in) {
        id = in.readInt();
        setDelivery(new ArrayList<Delivery>());
        in.readList(getDelivery(), Delivery.class.getClassLoader());
        enterprise = in.readParcelable(Enterprise.class.getClassLoader());
        razao_social = in.readString();
        nome_fantasia = in.readString();
//        tipo_pessoa = in.readCharArray();
        cpf_cnpj = in.readString();
        email = in.readString();
        telefone = in.readString();
        contato = in.readString();
        CEP = in.readString();
        UF = in.readString();
        cidade = in.readString();
        bairro = in.readString();
        logradouro = in.readString();
        numero = in.readString();
        complemento = in.readString();
        latitude = in.readDouble();
        longitude = in.readDouble();
        situacao = in.readByte() > 0;
    }

    public static final Creator<Addressee> CREATOR = new Creator<Addressee>() {
        @Override
        public Addressee createFromParcel(Parcel in) {
            return new Addressee(in);
        }

        @Override
        public Addressee[] newArray(int size) {
            return new Addressee[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(id);
        parcel.writeList(delivery);
        parcel.writeParcelable(enterprise, i);
        parcel.writeString(razao_social);
        parcel.writeString(nome_fantasia);
//        tipo
        parcel.writeString(cpf_cnpj);
        parcel.writeString(email);
        parcel.writeString(telefone);
        parcel.writeString(contato);
        parcel.writeString(CEP);
        parcel.writeString(UF);
        parcel.writeString(cidade);
        parcel.writeString(bairro);
        parcel.writeString(logradouro);
        parcel.writeString(numero);
        parcel.writeString(complemento);
        parcel.writeDouble(latitude);
        parcel.writeDouble(longitude);
        parcel.writeByte((byte) (situacao ? 1 : 0));
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public List<Delivery> getDelivery() {
        return delivery;
    }

    public void setDelivery(List<Delivery> delivery) {
        this.delivery = delivery;
    }

    public Enterprise getEnterprise() {
        return enterprise;
    }

    public void setEnterprise(Enterprise enterprise) {
        this.enterprise = enterprise;
    }

    public String getRazao_social() {
        return razao_social;
    }

    public void setRazao_social(String razao_social) {
        this.razao_social = razao_social;
    }

    public String getNome_fantasia() {
        return nome_fantasia;
    }

    public void setNome_fantasia(String nome_fantasia) {
        this.nome_fantasia = nome_fantasia;
    }

    public char getTipo_pessoa() {
        return tipo_pessoa;
    }

    public void setTipo_pessoa(char tipo_pessoa) {
        this.tipo_pessoa = tipo_pessoa;
    }

    public String getCpf_cnpj() {
        return cpf_cnpj;
    }

    public void setCpf_cnpj(String cpf_cnpj) {
        this.cpf_cnpj = cpf_cnpj;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getTelefone() {
        return telefone;
    }

    public void setTelefone(String telefone) {
        this.telefone = telefone;
    }

    public String getContato() {
        return contato;
    }

    public void setContato(String contato) {
        this.contato = contato;
    }

    public String getCEP() {
        return CEP;
    }

    public void setCEP(String CEP) {
        this.CEP = CEP;
    }

    public String getUF() {
        return UF;
    }

    public void setUF(String UF) {
        this.UF = UF;
    }

    public String getCidade() {
        return cidade;
    }

    public void setCidade(String cidade) {
        this.cidade = cidade;
    }

    public String getBairro() {
        return bairro;
    }

    public void setBairro(String bairro) {
        this.bairro = bairro;
    }

    public String getLogradouro() {
        return logradouro;
    }

    public void setLogradouro(String logradouro) {
        this.logradouro = logradouro;
    }

    public String getNumero() {
        return numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public String getComplemento() {
        return complemento;
    }

    public void setComplemento(String complemento) {
        this.complemento = complemento;
    }

    public double getLatitude() {
        return latitude;
    }

    public void setLatitude(double latitude) {
        this.latitude = latitude;
    }

    public double getLongitude() {
        return longitude;
    }

    public void setLongitude(double longitude) {
        this.longitude = longitude;
    }

    public boolean isSituacao() {
        return situacao;
    }

    public void setSituacao(boolean situacao) {
        this.situacao = situacao;
    }
}
