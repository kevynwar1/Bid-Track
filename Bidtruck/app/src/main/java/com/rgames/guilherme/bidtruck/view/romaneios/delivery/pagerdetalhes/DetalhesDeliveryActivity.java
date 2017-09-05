package com.rgames.guilherme.bidtruck.view.romaneios.delivery.pagerdetalhes;

import android.os.Bundle;
import android.os.Parcelable;
import android.support.design.widget.TabLayout;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.MenuItem;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.util.List;

public class DetalhesDeliveryActivity extends AppCompatActivity {


    private ViewPager mViewPager;
    private TabLayout mTabLayout;
    private Delivery mEntrega;
    private Romaneio mRomaneio;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_estudo);
        try {
            if (getIntent().getExtras() != null) {
                mRomaneio = getIntent().getExtras().getParcelable(Romaneio.PARCEL);
                int index = getIntent().getExtras().getInt(Delivery.PARCEL);
                mEntrega = mRomaneio.getDeliveryList().get(index);
            } else {
                onBackPressed();
                throw new NullPointerException("Delivery nula.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        try {
            init();
            initViewPager();
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

    private void initViewPager() {
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
