package com.rgames.guilherme.bidtruck.view.delivery.pagerestudo.pager;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Addressee;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Occurrence;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.StatusDelivery;
import com.rgames.guilherme.bidtruck.model.basic.TypeOccurrence;
import com.rgames.guilherme.bidtruck.view.delivery.pagerestudo.adapter.AdapterRecyclerEntregas;

import java.util.ArrayList;
import java.util.List;

public class PagerEntregaFragment extends Fragment {
    private View mView;
    private MyProgressBar myProgressBar;
    private List<Delivery> mListDeliveries;

    public PagerEntregaFragment() {

    }

    public static PagerEntregaFragment newInstance() {
        return new PagerEntregaFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public void onResume() {
        super.onResume();
        initList();
        Log.i("teste", "iniciando rec");
        mListDeliveries = new ArrayList<>();
        Delivery delivery = new Delivery(
                0, "Entrega 1"
                , new Romaneio(0, 's', false)
                , new Addressee(0)
                , new StatusDelivery(0, new Occurrence(0, new TypeOccurrence(0, "", 's'), "", 's'), null)
                , 0f, null, false);
        mListDeliveries.add(delivery);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_pager_entrega, container, false);
    }

    @Override
    public void onPause() {
        super.onPause();
        try {
            finishProgressBar();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void initList() {
        new AsyncTask<Void, Void, Void>() {
            @Override
            protected void onPreExecute() {
                try {
                    initProgressBar();
                } catch (Exception e) {
                    //sem tratamento, so na maciota por enquanto.
                    e.printStackTrace();
                }
            }

            @Override
            protected Void doInBackground(Void... voids) {
                return null;
            }

            @Override
            protected void onPostExecute(Void aVoid) {
                try {
                    initRecyclerView();
                    finishProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }

    private void initRecyclerView() throws Exception {
        RecyclerView r = mView.findViewById(R.id.recyclerview);
        if (getActivity() != null)
            r.setLayoutManager(new LinearLayoutManager(getActivity()));
        else
            throw new NullPointerException("Context nulo");
        r.setAdapter(new AdapterRecyclerEntregas(mListDeliveries, getActivity()));
    }

    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (myProgressBar == null)
            myProgressBar = new MyProgressBar((FrameLayout) mView.findViewById(R.id.frame_progress));
    }

    private void finishProgressBar() throws Exception {
        if (myProgressBar != null) {
            myProgressBar.onFinish();
        }
    }
}
