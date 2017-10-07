package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;

import java.util.List;

/**
 * Created by Guilherme on 05/09/2017.
 */

public class AdapterRecyclerOcorrencia extends RecyclerView.Adapter<AdapterRecyclerOcorrencia.MyViewPager> {

    private List<Ocorrencia> mList;

    public AdapterRecyclerOcorrencia(List<Ocorrencia> ocorrencias) {
        mList = ocorrencias;
    }

    @Override
    public MyViewPager onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewPager(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_ocorrencia, parent, false));
    }

    @Override
    public void onBindViewHolder(MyViewPager holder, int position) {
        holder.txtTipo.setText(String.valueOf(mList.get(position).getTipoOcorrencia().getDescription()));
        holder.txtData.setText(String.valueOf(mList.get(position).getData()));
        holder.txtDesc.setText(String.valueOf(mList.get(position).getDescricao()));
    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public class MyViewPager extends RecyclerView.ViewHolder {

        public TextView txtData, txtDesc, txtTipo;

        public MyViewPager(View itemView) {
            super(itemView);
            txtData = itemView.findViewById(R.id.txt_data);
            txtTipo = itemView.findViewById(R.id.txt_tipo);
            txtDesc = itemView.findViewById(R.id.txt_descricao);
        }
    }
}
