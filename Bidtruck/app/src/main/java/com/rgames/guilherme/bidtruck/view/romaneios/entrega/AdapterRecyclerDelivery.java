package com.rgames.guilherme.bidtruck.view.romaneios.entrega;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.errors.ContextNullException;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.DetalhesEntregaActivity;


import java.util.ArrayList;
import java.util.List;

public class AdapterRecyclerDelivery extends RecyclerView.Adapter<AdapterRecyclerDelivery.MyViewHolder> {

    private Romaneio mRomaneio;
    private List<Entrega> mListEntrega;
    private Context mContext;

    public AdapterRecyclerDelivery(Romaneio romaneio, Context context) throws ContextNullException{
        if (romaneio != null) {
            mListEntrega = (romaneio.getEntregaList() != null) ? romaneio.getEntregaList() : new ArrayList<Entrega>();
            mRomaneio = romaneio;
        } else Toast.makeText(context, context.getString(R.string.app_err_null_romaneio), Toast.LENGTH_SHORT).show();
        if (context != null) mContext = context;
        else throw new ContextNullException();
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_entregas, parent, false));
    }

    @Override
    public void onBindViewHolder(final MyViewHolder holder, int position) {
        try {
            holder.codigo.setText(String.valueOf(mListEntrega.get(holder.getAdapterPosition()).getCodigo()));
            holder.razao_social.setText(mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getRazao_social());
            holder.bairro.setText((mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getBairro()));
            holder.cidade.setText(mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getCidade());
            holder.uf.setText(mListEntrega.get(holder.getAdapterPosition()).getDestinatario().getUF());
           // holder.status_entrega.setText(mListEntrega.get(holder.getAdapterPosition()).getStatusEntrega().getDescricao());


            holder.cardView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    try {
                        /*Vou passar o index pois tive problemas com a passagem de dois Parcelables.. talvez pq o bundle
                        * sobreescreva o put e a utilização do arrayParce tbm teve problemas*/
                        Intent intent = new Intent(mContext, DetalhesEntregaActivity.class);
                        //Intent intent = new Intent(mContext, FinalizaEntrega.class);
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
        return mListEntrega.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView codigo, titulo, seq_entrega, razao_social, bairro, uf, cidade, status_entrega;
        public CardView cardView;
        //final TextView cod_romaneio;

        public MyViewHolder(View itemView) {
            super(itemView);
            // titulo = itemView.findViewById(R.id.titulo);
            //seq_entrega =  itemView.findViewById(R.id.txtSequencia);
            codigo = itemView.findViewById(R.id.txtSequencia);
            razao_social = itemView.findViewById(R.id.txtRazao);
            bairro = itemView.findViewById(R.id.txtBairro);
            cidade = itemView.findViewById(R.id.txtCidade);
            uf = itemView.findViewById(R.id.txtUF);
          //  status_entrega = itemView.findViewById(R.id.txtStatusEntrega);
            cardView = itemView.findViewById(R.id.cardview);


        }
    }
}
