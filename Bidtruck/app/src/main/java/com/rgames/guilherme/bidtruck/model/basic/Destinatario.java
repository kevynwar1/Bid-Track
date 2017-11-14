package com.rgames.guilherme.bidtruck.model.basic;

import android.os.Parcel;
import android.os.Parcelable;

import java.util.ArrayList;
import java.util.List;

/**
 * Classe do destinátio.
 */
public class Destinatario implements Parcelable {

    private int codigo;
    private List<Entrega> entrega;
    private Empresa empresa;
    private String razao_social;
    private String nome_fantasia;
    private char tipo_pessoa;
    private String cnpj_cpf;
    private String email;
    private String telefone;
    private String contato;
    private String cep;
    private String uf;
    private String cidade;
    private String bairro;
    private String logradouro;
    private String numero;
    private String complemento;
    private double latitude;
    private double longitude;
    private boolean situacao;

    public Destinatario() {
    }

    public Destinatario(int id, List<Entrega> entrega, Empresa empresa, String razao_social, String nome_fantasia, char tipo_pessoa, String cnpj_cpf, String email, String telefone, String contato, String CEP, String UF, String cidade, String bairro, String logradouro, String numero, String complemento, double latitude, double longitude, boolean situacao) {
        this.codigo = id;
        this.entrega = entrega;
        this.empresa = empresa;
        this.razao_social = razao_social;
        this.nome_fantasia = nome_fantasia;
        this.tipo_pessoa = tipo_pessoa;
        this.cnpj_cpf = cnpj_cpf;
        this.email = email;
        this.telefone = telefone;
        this.contato = contato;
        this.cep = CEP;
        this.uf = UF;
        this.cidade = cidade;
        this.bairro = bairro;
        this.logradouro = logradouro;
        this.numero = numero;
        this.complemento = complemento;
        this.latitude = latitude;
        this.longitude = longitude;
        this.situacao = situacao;
    }

    protected Destinatario(Parcel in) {
        codigo = in.readInt();
        setEntrega(new ArrayList<Entrega>());
        in.readList(getEntrega(), Entrega.class.getClassLoader());
        empresa = in.readParcelable(Empresa.class.getClassLoader());
        razao_social = in.readString();
        nome_fantasia = in.readString();
//        tipo_pessoa = in.readCharArray();
        cnpj_cpf = in.readString();
        email = in.readString();
        telefone = in.readString();
        contato = in.readString();
        cep = in.readString();
        uf = in.readString();
        cidade = in.readString();
        bairro = in.readString();
        logradouro = in.readString();
        numero = in.readString();
        complemento = in.readString();
        latitude = in.readDouble();
        longitude = in.readDouble();
        situacao = in.readByte() > 0;
    }

    public static final Creator<Destinatario> CREATOR = new Creator<Destinatario>() {
        @Override
        public Destinatario createFromParcel(Parcel in) {
            return new Destinatario(in);
        }

        @Override
        public Destinatario[] newArray(int size) {
            return new Destinatario[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeInt(codigo);
        parcel.writeList(entrega);
        parcel.writeParcelable(empresa, i);
        parcel.writeString(razao_social);
        parcel.writeString(nome_fantasia);
//        tipo
        parcel.writeString(cnpj_cpf);
        parcel.writeString(email);
        parcel.writeString(telefone);
        parcel.writeString(contato);
        parcel.writeString(cep);
        parcel.writeString(uf);
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
        return codigo;
    }

    public void setId(int id) {
        this.codigo = id;
    }

    public List<Entrega> getEntrega() {
        return entrega;
    }

    public void setEntrega(List<Entrega> entrega) {
        this.entrega = entrega;
    }

    public Empresa getEmpresa() {
        return empresa;
    }

    public void setEmpresa(Empresa empresa) {
        this.empresa = empresa;
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
        return cnpj_cpf;
    }

    public void setCpf_cnpj(String cnpj_cpf) {
        this.cnpj_cpf = cnpj_cpf;
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
        return cep;
    }

    public void setCEP(String CEP) {
        this.cep = CEP;
    }

    public String getUF() {
        return uf;
    }

    public void setUF(String UF) {
        this.uf = UF;
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
