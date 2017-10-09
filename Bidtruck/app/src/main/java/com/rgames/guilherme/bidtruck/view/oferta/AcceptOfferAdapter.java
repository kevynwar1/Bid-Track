package com.rgames.guilherme.bidtruck.view.oferta;


import android.content.Context;
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

public class AcceptOfferAdapter extends ArrayAdapter<Entrega>{

    private Context mContext;
    private List<Entrega> deliverys;

    public AcceptOfferAdapter(Context c, List<Entrega> list){
        super(c, 0, list);
        this.mContext = c;
        this.deliverys = list;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = null;
        if(deliverys != null){
            LayoutInflater inflater = (LayoutInflater) mContext.getSystemService(mContext.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.list_deliverys, parent, false);
            Entrega delivery = deliverys.get(position);

            TextView razaoSocial = (TextView) view.findViewById(R.id.txtRazaoOffer);
            TextView bairro = (TextView) view.findViewById(R.id.txtBairroOffer);
            TextView cidade = (TextView) view.findViewById(R.id.txtCidadeOffer);
            TextView uf = (TextView) view.findViewById(R.id.txtUFOffer);
            TextView status = (TextView) view.findViewById(R.id.txtStatusEntregaOffer);

            razaoSocial.setText(delivery.getDestinatario().getRazao_social());
            bairro.setText(delivery.getDestinatario().getBairro());
            cidade.setText(delivery.getDestinatario().getCidade());
            uf.setText(delivery.getDestinatario().getUF());
            status.setText(delivery.getStatusEntrega().getDescricao());
        }
        return view;
    }
}
