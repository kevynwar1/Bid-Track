package com.rgames.guilherme.bidtruck.view.romaneios.entrega;

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
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.DetalhesEntregaActivity;


import java.util.ArrayList;
import java.util.List;

public class AdapterRecyclerDelivery extends RecyclerView.Adapter<AdapterRecyclerDelivery.MyViewHolder> {

    private Romaneio mRomaneio;
    private List<Entrega> mListEntrega;
    private Context mContext;

    public AdapterRecyclerDelivery(Romaneio romaneio, Context context) {
        if (romaneio != null) {
            mListEntrega = (romaneio.getEntregaList() != null) ? romaneio.getEntregaList() : new ArrayList<Entrega>();
            mRomaneio = romaneio;
        } else throw new NullPointerException("Romaneio nulo");
        if (context != null) mContext = context;
        else throw new NullPointerException("Contexto nulo");
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_entregas, parent, false));

        // View v = LayoutInflater.from(mContext).inflate(R.layout.adapter_recycler_entregas, parent, false);

       // EntregasViewHolder holder = new EntregasViewHolder(v);

       // return holder;

    }

    @Override
    public void onBindViewHolder(final MyViewHolder holder, int position) {
        try {
            Log.i("teste", mListEntrega.get(position).getCodigo() + " :Codigo");


            /*Entrega entrega = mListEntrega.get(position);
            Destinatario destiny = new Destinatario();


            holder.seq_entrega.setText(entrega.getCodigo());
            holder.razao_social.setText(destiny.getRazao_social());
            holder.bairro.setText(destiny.getBairro());
            holder.cidade.setText(destiny.getCidade());
            holder.uf.setText(destiny.getUF());*/


            //holder.titulo.setText(mListEntrega.get(holder.getAdapterPosition()).getTitulo());


            holder.codigo.setText(Integer.toString(mListEntrega.get(holder.getAdapterPosition()).getCodigo()));
            holder.razao_social.setText(mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getRazao_social());
            holder.bairro.setText((mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getBairro()));
            holder.cidade.setText(mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getCidade());
            holder.uf.setText(mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getUF());

            holder.cardView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    try {
                        /*Vou passar o index pois tive problemas com a passagem de dois Parcelables.. talvez pq o bundle
                        * sobreescreva o put e a utilização do arrayParce tbm teve problemas*/
                        Intent intent = new Intent(mContext, DetalhesEntregaActivity.class);
                        Bundle bundle = new Bundle();
                        bundle.putInt(Entrega.PARCEL, holder.getAdapterPosition());
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
        return  mListEntrega.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView codigo;
        public TextView titulo;
        public CardView cardView;
        public  TextView seq_entrega;
        public  TextView razao_social;
        public  TextView bairro;
        public final TextView uf;
        //final TextView cod_romaneio;
        public  TextView cidade;



        public MyViewHolder(View itemView) {
            super(itemView);
           // titulo = itemView.findViewById(R.id.titulo);
            //seq_entrega =  itemView.findViewById(R.id.txtSequencia);
            codigo = itemView.findViewById(R.id.txtSequencia);
            razao_social =  itemView.findViewById(R.id.txtRazao);
            bairro = itemView.findViewById(R.id.txtBairro);
            cidade = itemView.findViewById(R.id.txtCidade);
            uf = itemView.findViewById(R.id.txtUF);
            cardView = itemView.findViewById(R.id.cardview);
        }
    }
}
