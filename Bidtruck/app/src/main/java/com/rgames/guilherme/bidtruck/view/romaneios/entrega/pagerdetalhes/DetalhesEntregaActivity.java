package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes;

import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.MenuItem;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

public class DetalhesEntregaActivity extends AppCompatActivity {


    private ViewPager mViewPager;
    private TabLayout mTabLayout;
    private Entrega mEntrega;
    private Romaneio mRomaneio;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_estudo);
        try {
            if (getIntent().getExtras() != null) {
                mRomaneio = getIntent().getExtras().getParcelable(Romaneio.PARCEL);
                mEntrega = (Entrega) getIntent().getExtras().getSerializable(Entrega.PARCEL);
                init();
                initViewPager();
            } else {
                Toast.makeText(this, getString(R.string.app_err_null_entrega), Toast.LENGTH_SHORT).show();
                onBackPressed();
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

    private void initViewPager() throws Exception {
        mViewPager = (ViewPager) findViewById(R.id.viewpager);
        mViewPager.setAdapter(new AdapterViewPager(getSupportFragmentManager(), this, mRomaneio, mEntrega));
        mTabLayout = (TabLayout) findViewById(R.id.tablayout);
        mTabLayout.post(new Runnable() {
            @Override
            public void run() {
                mTabLayout.setupWithViewPager(mViewPager);
            }
        });
    }

    private void init() throws Exception {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(getString(R.string.app_title_estudo_detalhes));
    }
}
