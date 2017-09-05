package com.rgames.guilherme.bidtruck.view.romaneios.delivery;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.Parcelable;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.view.romaneios.delivery.pagerdetalhes.DetalhesDeliveryActivity;

import java.util.ArrayList;
import java.util.List;

public class AdapterRecyclerDelivery extends RecyclerView.Adapter<AdapterRecyclerDelivery.MyViewHolder> {

    private Romaneio mRomaneio;
    private List<Delivery> mList;
    private Context mContext;

    public AdapterRecyclerDelivery(Romaneio romaneio, Context context) {
        if (romaneio != null) {
            mList = (romaneio.getDeliveryList() != null) ? romaneio.getDeliveryList() : new ArrayList<Delivery>();
            mRomaneio = romaneio;
        } else throw new NullPointerException("Romaneio nulo");
        if (context != null) mContext = context;
        else throw new NullPointerException("Contexto nulo");
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_home, parent, false));
    }

    @Override
    public void onBindViewHolder(final MyViewHolder holder, int position) {
        try {
            holder.titulo.setText(mList.get(holder.getAdapterPosition()).getTitulo());
            holder.cardView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    try {
                        /*Vou passar o index pois tive problemas com a passagem de dois Parcelables.. talvez pq o bundle
                        * sobreescreva o put e a utilização do arrayParce tbm teve problemas*/
                        Intent intent = new Intent(mContext, DetalhesDeliveryActivity.class);
                        Bundle bundle = new Bundle();
                        bundle.putInt(Delivery.PARCEL, holder.getAdapterPosition());
                        bundle.putParcelable(Romaneio.PARCEL, mRomaneio);
                        mContext.startActivity(intent.putExtras(bundle));
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
            });
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView titulo;
        public CardView cardView;

        public MyViewHolder(View itemView) {
            super(itemView);
            titulo = itemView.findViewById(R.id.titulo);
            cardView = itemView.findViewById(R.id.cardview);
        }
    }
}
