package com.rgames.guilherme.bidtruck.model.dao.database;

import android.provider.BaseColumns;

/**
 * Created by Kevyn on 18/10/2017.
 */

public interface OcorrenciaTable extends BaseColumns {
    public static String TABELA = "ocorrencia";

    public static String CODIGO = "codigo";
    public static String COD_EMPRESA = "cod_empresa";
    public static String SEQ_ENTREGA = "seq_entrega";
    public static String COD_ROMANEIO = "cod_romaneio";
    public static String COD_TIPO_OCORRENCIA = "cod_tipo_ocorrencia";
    public static String DESCRICAO = "descricao";
    public static String FOTO = "foto";
    public static String SITUACAO = "situacao";
}
