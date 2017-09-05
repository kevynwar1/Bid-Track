package com.rgames.guilherme.bidtruck.view.romaneios.delivery;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

public class DeliveryActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_delivery);
        try {
            if (getIntent().getExtras() != null) {
                Romaneio romaneio = getIntent().getExtras().getParcelable(Romaneio.PARCEL);
                getSupportFragmentManager().beginTransaction()
                        .replace(R.id.content_delivery, DeliveryFragment.newInstance(romaneio)).commit();
            } else {
                onBackPressed();
                throw new NullPointerException("Romaneio nulo.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        try {
            init();
//            initViewPager();
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

//    private void initViewPager() {
//        mViewPager = (ViewPager) findViewById(R.id.viewpager);
//        mViewPager.setAdapter(new AdapterViewPager(getSupportFragmentManager(), this, mEntrega));
//        mTabLayout = (TabLayout) findViewById(R.id.tablayout);
//        mTabLayout.post(new Runnable() {
//            @Override
//            public void run() {
//                mTabLayout.setupWithViewPager(mViewPager);
//            }
//        });
//    }

    private void init() throws Exception {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
    }

}
