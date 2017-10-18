package com.rgames.guilherme.bidtruck.model.dao.database;

import android.provider.BaseColumns;

/**
 * Created by Kevyn on 18/10/2017.
 */

public interface DestinatarioTable extends BaseColumns {
    public static String TABELA = "destinatario";

    public static String CODIGO = "codigo";
    public static String COD_EMPRESA = "cod_empresa";
    public static String RAZAO_SOCIAL = "razao_social";
    public static String NOME_FANTASIA = "nome_fantasia";
    public static String TIPO_PESSOA = "tipo_pessoa";
    public static String CNPJ_CPF = "cnpj_cpf";
    public static String EMAIL = "email";
    public static String TELEFONE = "telefone";
    public static String LOGRADOURO = "logradouro";
    public static String NUMERO = "numero";
    public static String COMPLEMENTO = "complemento";
    public static String BAIRRO = "bairro";
    public static String CIDADE = "cidade";
    public static String UF = "uf";
    public static String CEP = "cep";
    public static String LATITUDE = "latitude";
    public static String LONGITUDE = "longitude";
    public static String SITUACAO = "situacao";


}
