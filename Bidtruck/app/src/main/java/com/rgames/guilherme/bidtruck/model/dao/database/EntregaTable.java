package com.rgames.guilherme.bidtruck.model.dao.database;

import android.provider.BaseColumns;

/**
 * Created by Kevyn on 18/10/2017.
 */

public interface EntregaTable extends BaseColumns {
    public static String TABELA = "entrega";

    public static String SEQ_ENTREGA = "seq_entrega";
    public static String COD_ROMANEIO = "cod_romaneio";
    public static String NOTA_FISCAL = "nota_fiscal";
    public static String PESO_CARGA = "peso_carga";


    public static String CNPJ = "cnpj";
    public static String EMAIL = "email";
    public static String TELEFONE = "telefone";
    public static String CEP = "cep";
    public static String UF = "uf";
    public static String CIDADE = "cidade";
    public static String BAIRRO = "bairro";
    public static String LOGRADOURO = "logradouro";
    public static String NUMERO = "numero";
    public static String COMPLEMENTO = "complemento";

    public static String COD_DESTINATARIO = "cod_destinatario";
    public static String LATITUDE = "latitude";
    public static String LONGITUDE = "longitude";
    public static String NOME_FANTASIA_DESTINATARIO = "nome_fantasia_destinatario";
    public static String RAZAO_SOCIAL_DESTINATARIO = "razao_social_destinatario";

    public static String COD_STATUS_ENTREGA = "cod_status_entrega";
    public static String DESCRICAO_STATUS = "descricao_status";

}
