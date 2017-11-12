package com.rgames.guilherme.bidtruck.view.oferta;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.squareup.picasso.Picasso;

import java.io.IOException;
import java.io.InputStream;
import java.net.MalformedURLException;
import java.net.URL;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.List;

public class OfferAdapter extends ArrayAdapter<Romaneio> {

    private Context context;
    private List<Romaneio> offers;

    public OfferAdapter(Context c, List<Romaneio> list) {
        super(c, 0, list);
        this.context = c;
        this.offers = list;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = null;
        if (offers != null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.lista_oferta, parent, false);
            TextView code = view.findViewById(R.id.cod_oferta);
            TextView payment = view.findViewById(R.id.dinheiro_oferta);
            TextView peso = view.findViewById(R.id.peso_oferta);
            ImageView imagem = view.findViewById(R.id.thumbnail2);
            Context contextx = imagem.getContext();
            Romaneio offer = offers.get(position);
            String test = offer.getEstabelecimento().getLogradouro();
            String maria = offer.getEstabelecimento().getBairro();
            String fof = maria.replace(" ","+");
            String bob = test.replace(" ", "+");
            String urlimagem = "https://maps.googleapis.com/maps/api/staticmap?center="+bob+fof+"&size=640x400&key=AIzaSyCCqyCKlw5Hj3hvPbMQ1C9OPyvcQQBhARU";
            Picasso.with(contextx)
                    .load(urlimagem)
                    .into(imagem);

            code.setText(Integer.toString(offer.getCodigo()));
            peso.setText("32,00 Kg");
            DecimalFormat df = new DecimalFormat("#,##0.00");
            payment.setText("R$ " + df.format(offer.getValor()));
        }
        return view;
    }
}
