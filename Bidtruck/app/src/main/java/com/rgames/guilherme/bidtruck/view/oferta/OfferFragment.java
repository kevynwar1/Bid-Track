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
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.R;

import java.util.List;

import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;

public class OfferFragment extends Fragment {

    private ArrayAdapter<Romaneio> offerAdapter;
    private ListView offerList;
    private List<Romaneio> offers;
    private List<Entrega> deliveries;
    private Preferences preferences;
    private OfferTask mTask;
    private TextView emptyView;
    private View view;

    public OfferFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle(getString(R.string.menu_drw_oferta));
            ((AppCompatActivity) getActivity()).getSupportActionBar().setDisplayShowTitleEnabled(true);
        }catch (Exception e){
            e.printStackTrace();
        }
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
                AcceptOfferFragment fragment = new AcceptOfferFragment();
                Bundle bundle = new Bundle();
                bundle.putParcelable("romaneio", offers.get(i));
                fragment.setArguments(bundle);

                FragmentTransaction fragmentTransaction = getActivity().getSupportFragmentManager().beginTransaction();
                fragmentTransaction.replace(R.id.content_main, fragment);
                fragmentTransaction.addToBackStack(null);
                fragmentTransaction.commit();
                /*
                getActivity().getSupportFragmentManager().beginTransaction()
                        .replace(R.id.content_main, fragment)
                        .addToBackStack(null)
                        .commit(); */
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
                HttpEntrega entrega = new HttpEntrega(getActivity());
                offers = oferta.loadOffers(preferences.getCompanyCode(), driverCode);
                if(!offers.isEmpty()){
                    for(int i = 0; i < offers.size(); i++){
                        Romaneio romaneio = offers.get(i);
                        offers.get(i).setEntregaList(entrega.selectByRomaneio(romaneio.getCodigo()));
                    }
                }
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
                offerList.setDividerHeight(15);
                offerList.setAdapter(offerAdapter);
            }
        }
    }
}