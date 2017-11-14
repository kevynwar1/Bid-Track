package com.rgames.guilherme.bidtruck.model.dao.database;

import android.provider.BaseColumns;

/**
 * Created by Kevyn on 18/10/2017.
 */

public interface RomaneioTable extends BaseColumns {
    public static String TABELA = "romaneio";

    public static String CODIGO = "codigo";
    public static String COD_EMPRESA = "cod_empresa";
    public static String COD_STATUS_ROMANEIO = "cod_status_romaneio";
    public static String COD_ESTABELECIMENTO = "cod_estabelecimento";
    public static String COD_MOTORISTA = "cod_motorista";
    //public static String COD_TRANSPORTADORA = "cod_transportadora";
    //public static String VALOR = "valor";
    // public static String COD_TIPO_VEICULO = "cod_tipo_veiculo";
    //public static String DATA_CRIACAO = "data_criacao";
    //public static String DATA_FINALIZACAO = "data_finalizacao";
}
