package com.rgames.guilherme.bidtruck.view.entrega.pagerestudo.adapter;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager.DetalhesEstudoActivity;

import java.util.ArrayList;
import java.util.List;

public class AdapterRecyclerEntregas extends RecyclerView.Adapter<AdapterRecyclerEntregas.MyViewHolder> {

    private List<Entrega> mList;
    private Context mContext;

    public AdapterRecyclerEntregas(List<Entrega> list, Context context) {
        mList = (list != null) ? list : new ArrayList<Entrega>();
        if (context != null) mContext = context;
        else throw new NullPointerException("Contexto nulo");
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_home, parent, false));
    }

    @Override
    public void onBindViewHolder(final MyViewHolder holder, int position) {
        holder.titulo.setText(mList.get(holder.getAdapterPosition()).getTitulo());
        holder.cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(mContext, DetalhesEstudoActivity.class);
                Bundle bundle = new Bundle();
                bundle.putParcelable(Entrega.PARCEL, mList.get(holder.getAdapterPosition()));
                mContext.startActivity(intent.putExtras(bundle));
            }
        });
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
