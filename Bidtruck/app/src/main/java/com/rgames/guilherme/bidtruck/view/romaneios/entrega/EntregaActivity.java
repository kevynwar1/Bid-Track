package com.rgames.guilherme.bidtruck.view.romaneios.entrega;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.widget.FrameLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;

import java.util.List;

public class EntregaActivity extends AppCompatActivity {

    private MyProgressBar myProgressBar;
    private Romaneio mRomaneio;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_delivery);
        try {
            if (getIntent().getExtras() != null) {
                mRomaneio = getIntent().getExtras().getParcelable(Romaneio.PARCEL);
                initToobal();
                initList();
                //            initViewPager();
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

    private void initToobal() throws Exception {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle(
                getResources().getString(R.string.menu_drw_entrega));
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
    }

    private void initList() {
        new AsyncTask<Void, Void, List<Entrega>>() {
            @Override
            protected void onPreExecute() {
                try {
                    initProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            protected List<Entrega> doInBackground(Void... String) {
                Facade facade = new Facade(EntregaActivity.this);
                try {
                    return facade.selectEntrega();
                } catch (Exception e) {
                    e.printStackTrace();
                }
                return null;
            }

            @Override
            protected void onPostExecute(List<Entrega> entregas) {
                try {
                    if (entregas == null) throw new NullPointerException("Lista de entregas nullo");
                    initRecyclerView(entregas);
                    finishProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }

    private void initRecyclerView(List<Entrega> entregas) throws Exception {
        RecyclerView r = (RecyclerView) findViewById(R.id.recyclerview);
        r.setLayoutManager(new LinearLayoutManager(this));
        mRomaneio.setEntregaList(entregas);
        r.setAdapter(new AdapterRecyclerDelivery(mRomaneio, this));
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

}
