package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.ocorrencia;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.AdapterRecyclerOcorrencia;

public class OcorrenciaActivity extends AppCompatActivity {

    private Entrega mEntrega;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_occurrence);
        try {
            if (getIntent().getExtras() != null) {
                mEntrega = getIntent().getExtras().getParcelable(Entrega.PARCEL);
                initToolbar();
//                initRecyclerView();
            } else {
                onBackPressed();
                throw new NullPointerException("Romaneio nulo.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();
        if (id == android.R.id.home) {
            onBackPressed();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private void initToolbar() throws Exception {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
    }
}
