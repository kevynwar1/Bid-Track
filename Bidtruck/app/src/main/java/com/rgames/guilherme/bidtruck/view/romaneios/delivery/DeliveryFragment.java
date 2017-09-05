package com.rgames.guilherme.bidtruck.view.romaneios.delivery;


import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Addressee;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;
import com.rgames.guilherme.bidtruck.model.basic.InitBasic;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.util.List;

public class DeliveryFragment extends Fragment {

    private View mView;
    private MyProgressBar myProgressBar;
    private Romaneio mRomaneio;

    public DeliveryFragment() {
    }

    public static DeliveryFragment newInstance(Romaneio romaneio) {
        DeliveryFragment fragment = new DeliveryFragment();
        Bundle bundle = new Bundle();
        bundle.putParcelable(Romaneio.PARCEL, romaneio);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        try {
            if (getArguments() != null)
                mRomaneio = getArguments().getParcelable(Romaneio.PARCEL);
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle(
                        getActivity().getResources().getString(R.string.menu_drw_entrega));
            ((AppCompatActivity) getActivity()).getSupportActionBar().setDisplayShowTitleEnabled(true);
        } catch (NullPointerException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            initList();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_delivery, container, false);
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

    @Override
    public void onStop() {
        super.onStop();
    }

    private void initList() {
        new AsyncTask<Void, Void, Romaneio>() {
            @Override
            protected void onPreExecute() {
                try {
                    initProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            protected Romaneio doInBackground(Void... voids) {
                return mRomaneio;
            }

            @Override
            protected void onPostExecute(Romaneio romaneio) {
                try {
                    initRecyclerView(romaneio);
                    finishProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }

    private void initRecyclerView(Romaneio romaneio) throws Exception {
        RecyclerView r = mView.findViewById(R.id.recyclerview);
        if (getActivity() != null)
            r.setLayoutManager(new LinearLayoutManager(getActivity()));
        else
            throw new NullPointerException("Context nulo");
        r.setAdapter(new AdapterRecyclerDelivery(romaneio, getActivity()));
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

