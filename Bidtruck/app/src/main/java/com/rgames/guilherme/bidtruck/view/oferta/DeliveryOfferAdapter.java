package com.rgames.guilherme.bidtruck.view.oferta;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;

import java.util.List;

public class DeliveryOfferAdapter extends RecyclerView.Adapter<DeliveryOfferAdapter.OffersViewHolder>{

    private List<Entrega> mDeliverys;
    private Context mContext;

    public DeliveryOfferAdapter(Context ctx, List<Entrega> deliverys){
        this.mDeliverys = deliverys;
        this.mContext = ctx;
    }

    @Override
    public OffersViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(mContext).inflate(R.layout.card_list_delivery, parent, false);
        OffersViewHolder holder = new OffersViewHolder(view);
        view.setTag(holder);

        return holder;
    }

    @Override
    public void onBindViewHolder(OffersViewHolder holder, int position) {
        Entrega delvy = this.mDeliverys.get(position);
        holder.seq_entrega.setText(String.valueOf(delvy.getSeq_entrega()));

    }

    @Override
    public int getItemCount() {
        return mDeliverys != null ? mDeliverys.size() : 0;
    }

    public static class OffersViewHolder extends RecyclerView.ViewHolder{

        public TextView seq_entrega;

        public OffersViewHolder(View view){
            super(view);
            this.seq_entrega = (TextView) view.findViewById(R.id.seq_entrega);
        }
    }
}
