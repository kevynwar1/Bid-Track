package com.rgames.guilherme.bidtruck.view.oferta;


import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOferta;

/**
 * A simple {@link Fragment} subclass.
 */
public class AcceptOfferFragment extends Fragment {

    private Button acceptBtn;
    private AcceptTask mTask;
    private boolean success;

    public AcceptOfferFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_accept_offer, container, false);
        acceptBtn = (Button) view.findViewById(R.id.accept_btn);
        mTask = new AcceptTask();

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
                        mTask.execute();
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

    class AcceptTask extends AsyncTask<Void, Void, Void>{
        @Override
            protected void onPreExecute() {
                super.onPreExecute();
        }

        @Override
        protected Void doInBackground(Void... voids) {
            HttpOferta mHttpOferta = new HttpOferta(getActivity());
            success = mHttpOferta.acceptOffer(9, 4321, 1, 3);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            if(success){
                Toast.makeText(getActivity(), "Confirmado com Sucesso!", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(getActivity(), "Desculpe, essa oferta não está mais disponível", Toast.LENGTH_LONG).show();
            }
        }
    }
}
