package com.rgames.guilherme.bidtruck.view.oferta;

/*
* QUALQUER SUGESTÃO OU DÚVIDA A RESPEITO DESSA CLASSE
* OU SUA FUNCIONALIDADE, POR FAVOR, P E R G U N T E
* NÃO ALTERE SEU CONTEÚDO POR CONTA PRÓPRIA, SUGIRA
* AO AUTOR AS ALTERAÇÕES A SEREM ADOTADAS E SE FOR
* O CASO, TAIS ALTERAÇÕES SERAM FEITAS. GRATO.
* @author Erick da Costa
* */

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.R;

import java.util.ArrayList;
import java.util.List;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;

import static android.R.attr.author;

public class OfferFragment extends Fragment {

    private ArrayAdapter<Romaneio> offerAdapter;
    private ListView offerList;
    private List<Romaneio> offers;
    private Preferences preferences;
    private OfferTask mTask;
    private TextView emptyView;
    private View view;

    public OfferFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        try {
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle(getString(R.string.menu_drw_oferta));
            ((AppCompatActivity) getActivity()).getSupportActionBar().setDisplayShowTitleEnabled(true);
        } catch (NullPointerException e) {
            e.printStackTrace();
        }
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_offer, container, false);
        offerList = view.findViewById(R.id.listViewOffers);
        offerList.setDivider(null);
        emptyView = view.findViewById(R.id.empty);
        preferences = new Preferences(getActivity());

        offerList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                getActivity().getSupportFragmentManager().beginTransaction()
                        .replace(R.id.content_main, new AcceptOfferFragment())
                        .addToBackStack(null)
                        .commit();
            }
        });
        mTask = new OfferTask();
        mTask.execute();

        return view;
    }


    class OfferTask extends AsyncTask<Void, Void, Void>{
        private ProgressBar progressBar;

        @Override
        protected void onPreExecute() {
            progressBar = view.findViewById(R.id.progress_offer);
            progressBar.setVisibility(View.VISIBLE);
        }

        @Override
        protected Void doInBackground(Void... voids) {
            try{
                int driverCode = new Facade(getActivity()).isLogged().getCodigo();
                HttpOferta oferta = new HttpOferta(getActivity());
                offers = oferta.loadOffers(preferences.getCompanyCode(), driverCode);

            }catch (Exception e){
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            progressBar.setVisibility(View.INVISIBLE);
            if(offers.isEmpty()){
                offerList.setEmptyView(emptyView);
            }else {
                offerAdapter = new OfferAdapter(getActivity(), offers);
                offerList.setAdapter(offerAdapter);
            }
        }
    }
}