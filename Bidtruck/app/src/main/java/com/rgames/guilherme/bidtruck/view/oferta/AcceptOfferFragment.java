package com.rgames.guilherme.bidtruck.view.oferta;


import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;
import com.rgames.guilherme.bidtruck.view.romaneios.RomaneioFragment;

import java.util.List;

/**
 * A simple {@link Fragment} subclass.
 */
public class AcceptOfferFragment extends Fragment {

    private Button acceptBtn;
    private acceptOfferTask mTaskAccept;
    private loadOfferTask mTaskLoad;
    private List<Entrega> deliverys;
    private boolean success;
    private ProgressBar progress;
    private View view;
    private ArrayAdapter<Entrega> deliveryAdapter;
    private ListView listView;
    private Preferences preferences;
    private Romaneio romaneio;


    public AcceptOfferFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {

        try {
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle(getString(R.string.toolbar_offer_details));
            ((AppCompatActivity) getActivity()).getSupportActionBar().setDisplayShowTitleEnabled(true);
        } catch (NullPointerException e) {
            e.printStackTrace();
        }
        super.onCreate(savedInstanceState);
    }



    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view = inflater.inflate(R.layout.fragment_accept_offer, container, false);
        acceptBtn = view.findViewById(R.id.accept_btn);
        listView = view.findViewById(R.id.deliveryListOffer);
        preferences = new Preferences(getActivity());
        romaneio = getArguments().getParcelable("romaneio");

        mTaskAccept = new acceptOfferTask();
        mTaskLoad = new loadOfferTask();
        mTaskLoad.execute();

        acceptBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final AlertDialog.Builder alertDialog = new AlertDialog.Builder(getActivity());
                alertDialog.setTitle("Confirmação");
                alertDialog.setMessage("Você confirma o aceite desta oferta?");
                alertDialog.setCancelable(false);

                alertDialog.setPositiveButton("CONFIRMAR", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        mTaskAccept.execute();
                    }
                });

                alertDialog.setNegativeButton("CANCELAR", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {

                    }
                });
                alertDialog.create();
                alertDialog.show();
            }
        });
        return view;
    }

    class acceptOfferTask extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            if (progress == null) {
                progress = view.findViewById(R.id.progress_acceptOffer);
                progress.setVisibility(View.VISIBLE);
            } else {
                progress.setVisibility(View.VISIBLE);
            }
        }

        @Override
        protected Void doInBackground(Void... voids) {
            HttpOferta mHttpOferta = new HttpOferta(getActivity());
            int driverCode = new Facade(getActivity()).isLogged().getCodigo();
            int companyCode = preferences.getCompanyCode();
            success = mHttpOferta.acceptOffer(driverCode, romaneio.getCodigo(), companyCode, romaneio.getEstabelecimento().getCodigo());
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            progress.setVisibility(View.INVISIBLE);
            if (success) {
                Toast.makeText(getActivity(), "Confirmado com Sucesso!", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(getActivity(), "Desculpe, essa oferta não está mais disponível", Toast.LENGTH_LONG).show();
            }
        }
    }

    class loadOfferTask extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            if (progress == null) {
                progress = view.findViewById(R.id.progress_acceptOffer);
                progress.setVisibility(View.VISIBLE);
            } else {
                progress.setVisibility(View.VISIBLE);
            }
        }

        @Override
        protected Void doInBackground(Void... voids) {
            HttpEntrega mHttpEntrega = new HttpEntrega(getActivity());
            deliverys = mHttpEntrega.selectByRomaneio(romaneio.getCodigo());
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            progress.setVisibility(View.INVISIBLE);
            deliveryAdapter = new AcceptOfferAdapter(getActivity(), deliverys);
            listView.setAdapter(deliveryAdapter);
        }
    }
}
