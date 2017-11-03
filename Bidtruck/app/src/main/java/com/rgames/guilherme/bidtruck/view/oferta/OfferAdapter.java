package com.rgames.guilherme.bidtruck.view.oferta;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.List;

public class OfferAdapter extends ArrayAdapter<Romaneio>{

    private Context context;
    private List<Romaneio> offers;

    public OfferAdapter(Context c, List<Romaneio> list){
        super(c, 0, list);
        this.context = c;
        this.offers = list;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = null;
        if(offers != null){
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.list_offers, parent, false);
            TextView code = view.findViewById(R.id.offer_code);
            TextView payment = view.findViewById(R.id.offer_payment);
            Romaneio offer = offers.get(position);
            code.setText(Integer.toString(offer.getCodigo()));
            DecimalFormat df = new DecimalFormat("#,##0.00");
            payment.setText(df.format(offer.getValor()));
        }
        return view;
    }
}
