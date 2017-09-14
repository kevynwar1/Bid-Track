package com.rgames.guilherme.bidtruck.view.oferta;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.R;

import java.util.ArrayList;
import java.util.List;

import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

public class OfferFragment extends Fragment {

    private ListView offerList;
    private Facade facade;
    private OfferAdapter offerAdapter;
    private View mView;
    private MyProgressBar myProgressBar;


    public OfferFragment() {
        // Required empty public constructor
    }

    public static OfferFragment newInstance() {
        return new OfferFragment();
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        try {
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle(
                        getActivity().getResources().getString(R.string.menu_drw_oferta));
            ((AppCompatActivity) getActivity()).getSupportActionBar().setDisplayShowTitleEnabled(true);
        } catch (NullPointerException e) {
            e.printStackTrace();
        }
        super.onCreate(savedInstanceState);
    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            offerList = (ListView) mView.findViewById(R.id.listViewOffers);
            offerList.setDivider(null);
            facade = new Facade(getActivity());
            loadOffers();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_offer, container, false);
    }

    private void loadOffers() {
        new AsyncTask<Void, Void, List<Romaneio>>() {
            @Override
            protected void onPreExecute() {
                initProgressBar();
            }

            @Override
            protected List<Romaneio> doInBackground(Void... voids) {
                try {
                    return facade.selectRomaneioOfertado(facade.isLogged());
                } catch (Exception e) {
                    e.printStackTrace();
                }
                return new ArrayList<Romaneio>();
            }

            @Override
            protected void onPostExecute(List<Romaneio> offers) {
                try {
                    if (offers == null || offers.size() == 0) {
                        Toast.makeText(getActivity(), "Não há ofertas disponíveis no momento", Toast.LENGTH_LONG).show();
                    } else {
                        offerAdapter = new OfferAdapter(getActivity(), offers);
                        offerList.setAdapter(offerAdapter);
                    }
                    finishProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
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