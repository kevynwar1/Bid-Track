package com.rgames.guilherme.bidtruck.model.dao.database;

import android.provider.BaseColumns;

/**
 * Created by Kevyn on 18/10/2017.
 */

public interface TipoOcorrenciaTable extends BaseColumns {
    public static String TABELA = "tipo_ocorrencia";

    public static String CODIGO = "codigo";
    public static String COD_EMPRESA = "cod_empresa";
    public static String DESCRICAO = "descricao";
    public static String SITUACAO = "situacao";
}
