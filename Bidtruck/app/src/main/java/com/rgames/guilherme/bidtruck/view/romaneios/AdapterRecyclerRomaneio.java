package com.rgames.guilherme.bidtruck.view.romaneios;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.EntregaActivity;

import java.util.ArrayList;
import java.util.List;

public class AdapterRecyclerRomaneio extends RecyclerView.Adapter<AdapterRecyclerRomaneio.MyViewHolder> {

    private List<Romaneio> mRomaneioList;
    private Context mContext;

    public AdapterRecyclerRomaneio(Context context, List<Romaneio> romaneioList) {
        this.mRomaneioList = romaneioList;
        this.mContext = context;
    }

    @Override
    public AdapterRecyclerRomaneio.MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_romaneios, parent, false));
    }

    @Override
    public void onBindViewHolder(final AdapterRecyclerRomaneio.MyViewHolder holder, int position) {
        try {
            Log.i("teste", "valor: " + mRomaneioList.get(position).getCodigo()+"");
            holder.titulo.setText(String.valueOf(mRomaneioList.get(position).getCodigo()));
            holder.cardview.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent(mContext, EntregaActivity.class);
                    Bundle bundle = new Bundle();
                    bundle.putParcelable(Romaneio.PARCEL, mRomaneioList.get(holder.getAdapterPosition()));
                    mContext.startActivity(intent.putExtras(bundle));
                }
            });
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    public int getItemCount() {
        if (mRomaneioList == null) mRomaneioList = new ArrayList<>();
        return mRomaneioList.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {

        TextView titulo;
        CardView cardview;

        public MyViewHolder(View itemView) {
            super(itemView);
            titulo = itemView.findViewById(R.id.titulo);
            cardview = itemView.findViewById(R.id.cardview);
        }
    }
}
