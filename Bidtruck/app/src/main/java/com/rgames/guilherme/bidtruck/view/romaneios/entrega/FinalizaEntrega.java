package com.rgames.guilherme.bidtruck.view.romaneios.entrega;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.util.List;

/**
 * Created by C. Eduardo on 26/09/2017.
 */

public class FinalizaEntrega extends AppCompatActivity{

    private Entrega mEntrega;
    private Romaneio mRomaneio;
    TextView status_entrega;
    Integer Cod_status_entrega;
    private Facade mFacade;


    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_finaliza_entrega);

        try {
            if (getIntent().getExtras() != null) {
                mRomaneio = getIntent().getExtras().getParcelable(Romaneio.PARCEL);
                int index = getIntent().getExtras().getInt(Entrega.PARCEL);
                mEntrega = mRomaneio.getEntregaList().get(index);

            } else {
                Toast.makeText(this, getString(R.string.app_err_null_entrega), Toast.LENGTH_SHORT).show();
                onBackPressed();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    @Override
    public void onResume(){
        super.onResume();

        if(mEntrega != null){
            alteraStatus();

        }
    }

    private void alteraStatus() {

        new AsyncTask<Void, Void, Entrega>() {
            String msg;

            @Override
            protected void onPreExecute() {

                try {

                    int codigo = mEntrega.getStatusEntrega().getCodigo();
                    if (codigo == 1 || codigo == 3) {
                        Cod_status_entrega = 4;
                        mEntrega.getStatusEntrega().setCodigo(Cod_status_entrega);
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            protected Entrega doInBackground(Void... Integer) {
                try {
                    //return mFacade.atualiza(mEntrega);
                } catch (Exception e) {
                    e.printStackTrace();
                }
                return null;
            }

            @Override
            protected void onPostExecute(Entrega entrega) {
                try {
                    if (entrega != null){
                         Toast.makeText(FinalizaEntrega.this,"Entrega alterada com sucesso.", Toast.LENGTH_LONG).show();
                    }
                    else
                        Toast.makeText(FinalizaEntrega.this, "Erro ao atualizar status da entrega.", Toast.LENGTH_LONG).show();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();


        }




}






