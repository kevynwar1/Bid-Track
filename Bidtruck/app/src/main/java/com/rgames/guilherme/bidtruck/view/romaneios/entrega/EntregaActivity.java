package com.rgames.guilherme.bidtruck.view.romaneios.entrega;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.FrameLayout;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;

import java.util.List;

public class EntregaActivity extends AppCompatActivity {

    private MyProgressBar myProgressBar;
    private Romaneio mRomaneio;
    private StatusRomaneioTask mRomaneioTask;
    private List<Entrega> mListEntregas;
    private boolean tem_romaneio;
    private boolean finish = true;
    private boolean atualizadaEntrega = true;
    private RetornaListaTask mRetornaTask;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_delivery);
        try {
            if (getIntent().getExtras() != null) {
                mRomaneio = getIntent().getExtras().getParcelable(Romaneio.PARCEL);
                initToobal();
               // initList();
                mRomaneioTask = new StatusRomaneioTask();

            } else {
                Toast.makeText(this, getString(R.string.app_err_null_romaneio), Toast.LENGTH_SHORT).show();
                onBackPressed();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }


    public void onResume(){
        super.onResume();

        try {
            if(finish == true){
                initList();
                finish = false;
            }
            else {

                    mRomaneio = getIntent().getExtras().getParcelable(Romaneio.PARCEL);
                    mRetornaTask = new RetornaListaTask();
                    mRetornaTask.execute();
                    mRomaneioTask.execute();


            }

        }catch (Exception e){
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
                    if (entregas == null || entregas.size() == 0)
                        emptyView(true);
                    initRecyclerView(entregas);
                    finishProgressBar();
                           // mListEntregas = entregas;

                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }


    class StatusRomaneioTask extends AsyncTask<Void, Void, Void>{


        @Override
        protected Void doInBackground(Void... voids) {

            try {

                HttpRomaneio mhttpRomaneio = new HttpRomaneio(EntregaActivity.this);
                if (mListEntregas != null) {

                    //for(int i = 0; i < mListEntregas.size(); i++){
                    Entrega mEtrenga = mListEntregas.get(mListEntregas.size() - 1);


                    if (mEtrenga.getStatusEntrega().getCodigo() == 4 && mRomaneio.getCodigo() > 0) {

                        int novo_status = 4;
                        int cod_romaneio = mRomaneio.getCodigo();
                        tem_romaneio = mhttpRomaneio.statusRomaneioEntrega(novo_status, cod_romaneio);

                    } else {
                        Toast.makeText(EntregaActivity.this, "Desculpe, este romaneio não pode ser finalizado!", Toast.LENGTH_SHORT).show();
                    }
                    //break;
                }
            }catch (Exception e){
                e.printStackTrace();
            }

            return null;
        }


        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            if(tem_romaneio) {
                Toast.makeText(EntregaActivity.this, "Romaneio finalizado com Sucesso!", Toast.LENGTH_LONG).show();
            } else {
                //Toast.makeText(EntregaActivity.this, "Desculpe, erro ao finalizar o romaneio atual, tente novamente!", Toast.LENGTH_LONG).show();
            }
        }
    }



       class RetornaListaTask extends AsyncTask<Void, Void, List<Entrega>> {


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
                    if (entregas == null || entregas.size() == 0)
                        emptyView(true);
                    initRecyclerView(entregas);
                    mListEntregas = entregas;

                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }















    private void emptyView(boolean isVisible) {
        findViewById(R.id.txt_empty).setVisibility((isVisible) ? View.VISIBLE : View.GONE);
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
