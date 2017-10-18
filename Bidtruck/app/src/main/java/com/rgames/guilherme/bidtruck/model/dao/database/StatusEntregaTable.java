package com.rgames.guilherme.bidtruck.model.dao.database;

import android.provider.BaseColumns;

/**
 * Created by Kevyn on 18/10/2017.
 */

public interface StatusEntregaTable extends BaseColumns {
    public static String TABELA = "status_entrega";

    public static String CODIGO = "codigo";
    public static String DESCRICAO = "descricao";
    public static String SITUACAO = "situacao";
}
