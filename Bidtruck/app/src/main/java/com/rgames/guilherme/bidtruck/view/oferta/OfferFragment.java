package com.rgames.guilherme.bidtruck.view.oferta;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.R;
import java.util.ArrayList;
import java.util.List;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;
import com.rgames.guilherme.bidtruck.view.oferta.OfferAdapter;

public class OfferFragment extends Fragment {

    private ListView offerList;
    private List<Romaneio> offers;
    private Facade facade;
    private OfferAdapter offerAdapter;


    public OfferFragment() {
        // Required empty public constructor
    }

    public static OfferFragment newInstance(){
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
            loadOffers();
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_offer, container, false);
        offerList = (ListView) view.findViewById(R.id.listViewOffers);
        offerList.setDivider(null);
        offers = new ArrayList<>();
        facade = new Facade(getActivity());
        return view;
    }

    private void loadOffers(){
        new AsyncTask<Void, Void, Void>(){
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
            }

            @Override
            protected Void doInBackground(Void... voids) {
                try{
                    HttpOferta oferta = new HttpOferta(getActivity());
                    Motorista motorista = facade.isLogged();
                    offers = oferta.loadOffers(motorista.getEmpresa().getCodigo(), motorista.getCodigo());
                }catch (Exception e){
                    e.printStackTrace();
                }
                return null;
            }

            @Override
            protected void onPostExecute(Void aVoid) {
                super.onPostExecute(aVoid);
                if(offers.size() == 0){
                    Toast.makeText(getActivity(),"Não há ofertas disponíveis no momento", Toast.LENGTH_LONG).show();
                }else {
                    offerAdapter = new OfferAdapter(getActivity(), offers);
                    offerList.setAdapter(offerAdapter);
                }
            }
        }.execute();
    }
}