package com.rgames.guilherme.bidtruck.model.dao.database;

import android.provider.BaseColumns;

/**
 * Created by Kevyn on 18/10/2017.
 */

public interface EntregaTable extends BaseColumns {
    public static String TABELA = "entrega";

    public static String SEQ_ENTREGA = "seq_entrega";
    public static String COD_ROMANEIO = "cod_romaneio";
    public static String COD_DESTINATARIO = "cod_destinatario";
    public static String COD_STATUS_ENTREGA = "cod_status_entrega";
    public static String PESO_CARGA = "peso_carga";
    public static String NOTA_FISCAL = "nota_fiscal";
}
