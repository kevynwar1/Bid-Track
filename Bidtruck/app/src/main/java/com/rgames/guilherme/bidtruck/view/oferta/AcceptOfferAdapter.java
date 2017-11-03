package com.rgames.guilherme.bidtruck.view.oferta;


import android.content.Context;
import android.graphics.Color;
import android.support.annotation.IntegerRes;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;

import java.util.List;

public class AcceptOfferAdapter extends ArrayAdapter<Entrega> {

    private Context mContext;
    private List<Entrega> deliverys;

    public AcceptOfferAdapter(Context c, List<Entrega> list) {
        super(c, 0, list);
        this.mContext = c;
        this.deliverys = list;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = null;
        if (deliverys != null) {
            LayoutInflater inflater = (LayoutInflater) mContext.getSystemService(mContext.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.adapter_recycler_entregas, parent, false);
            Entrega delivery = deliverys.get(position);


            TextView razaoSocial = (TextView) view.findViewById(R.id.txtRazao);
            TextView bairro = (TextView) view.findViewById(R.id.txtBairro);
            TextView logradouro = (TextView) view.findViewById(R.id.txtLogradouro);
            TextView numero = (TextView) view.findViewById(R.id.txtNumero);
            //    TextView status = (TextView) view.findViewById(R.id.txtStatusEntrega);
            //   View viewLateral = (View) view.findViewById(R.id.viewLateral);


            razaoSocial.setText(delivery.getDestinatario().getRazao_social());
            bairro.setText(delivery.getDestinatario().getBairro());
            logradouro.setText(delivery.getDestinatario().getLogradouro() + ", ");
            numero.setText(delivery.getDestinatario().getNumero() + " - ");
                      /*  String input = delivery.getStatusEntrega().getDescricao();
            input = input.toUpperCase();

            if (input.equals("EM VIAGEM")) {
                status.setTextColor(Color.parseColor("#FF9800"));
                status.setText(input);
                viewLateral.setBackgroundColor(Color.parseColor("#FF9800"));
            } else if (input.equals("FINALIZADO")) {
                status.setTextColor(Color.parseColor("#D32F2F"));
                status.setText(input);
                viewLateral.setBackgroundColor(Color.parseColor("#D32F2F"));
            } else if (input.equals("LIBERADO")) {
                status.setTextColor(Color.parseColor("#303F9F"));
                status.setText(input);
                viewLateral.setBackgroundColor(Color.parseColor("#303F9F"));
            }*/
        }
        return view;
    }
}
