package com.rgames.guilherme.bidtruck.view.empresa;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.view.main.MainActivity;
import com.rgames.guilherme.bidtruck.view.oferta.OfferAdapter;
import com.rgames.guilherme.bidtruck.view.oferta.OfferFragment;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.AdapterRecyclerDelivery;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.EntregaActivity;

import java.util.ArrayList;
import java.util.List;

public class EmpresasActivity extends AppCompatActivity {
    private ListView empresaList;
    private Facade facade;
    private EmpresaAdapter empresaAdapter;

    private MyProgressBar myProgressBar;
    Empresa empresas;
    private Motorista motorista;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.fragment_empresas);
        empresas = new Empresa();
        try {
            if (getIntent().getExtras() != null) {
                motorista = getIntent().getExtras().getParcelable(Motorista.PARCEL_MOTORISTA);
                initList();

            }

        } catch (Exception e) {
            e.printStackTrace();
        }

    }

  /*  private void initToobal() throws Exception {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle(
                getResources().getString(R.string.title_empresa));
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
    }*/

    private void initList() {
        new AsyncTask<Void, Void, List<Empresa>>() {
            @Override
            protected void onPreExecute() {
                try {
                    initProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            protected List<Empresa> doInBackground(Void... String) {
                facade = new Facade(EmpresasActivity.this);
                try {
                    return facade.selectEmpresa(motorista);
                } catch (Exception e) {
                    e.printStackTrace();
                }
                return null;
            }

            @Override
            protected void onPostExecute(List<Empresa> empresas) {
                try {
                    if (empresas.size() == 1) {
                        Intent it = new Intent(EmpresasActivity.this, MainActivity.class);
                        startActivity(it);
                        // Toast.makeText(EmpresasActivity.this, "Não há empresas disponíveis no momento", Toast.LENGTH_LONG).show();
                    } else {
                        initView(empresas);
                    }


                    finishProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }

    private void initView(List<Empresa> empresas) throws Exception {
        empresaList = (ListView) findViewById(R.id.lv_empresas);
        empresaAdapter = new EmpresaAdapter(getApplicationContext(), empresas);
        empresaList.setAdapter(empresaAdapter);
        clickLista();
    }


    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (myProgressBar == null)
            myProgressBar = new MyProgressBar((FrameLayout) findViewById(R.id.frame_progress));
    }

    private void finishProgressBar() throws Exception {
        if (myProgressBar != null) {
            myProgressBar.onFinish();
        }
    }

    private void clickLista() {
        empresaList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Empresa empresa = (Empresa) adapterView.getAdapter().getItem(i);

                Intent it = new Intent(EmpresasActivity.this, MainActivity.class);
                Bundle b = new Bundle();
                b.putParcelable(Empresa.PARCEL, empresa);
                b.putParcelable(Motorista.PARCEL_MOTORISTA, motorista);
                startActivity(it);
            }
        });
    }


}
