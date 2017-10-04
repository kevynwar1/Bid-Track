package com.rgames.guilherme.bidtruck.model.dao.http;

import android.content.Context;
import android.content.Intent;

import java.io.InputStream;

/**
 * Created by C. Eduardo on 03/10/2017.
 */

public class HttpUtils  {




    public void atualizaEntrega(Context context, Integer cod_romaneio, Integer cod_status_entrega, Integer cod_sequencial) throws Exception{

        final String urlServidor = "(http://coopera.pe.hu/ws/entrega_status_entrega/$status_entrega/$seq_entrega/$romaneio";
        InputStream fileInputStream = null;
       // DataOutPutStream outputStream = null




    }
}
