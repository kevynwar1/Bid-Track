package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;

import java.util.List;

class AdapterRecyclerOcorrencia extends RecyclerView.Adapter<AdapterRecyclerOcorrencia.MyViewPager> {

    private List<Ocorrencia> mList;

    AdapterRecyclerOcorrencia(List<Ocorrencia> ocorrencias) {
        mList = ocorrencias;
    }

    @Override
    public MyViewPager onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewPager(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_ocorrencia, parent, false));
    }

    @Override
    public void onBindViewHolder(MyViewPager holder, int position) {
        holder.txtTipo.setText(String.valueOf(mList.get(position).getTipoOcorrencia().getDescription()));
        if (mList.get(holder.getAdapterPosition()).getData() == null)
            holder.txtData.setText(String.valueOf("20/11/2017"));
        else
            holder.txtData.setText(String.valueOf(mList.get(position).getData()));
        holder.txtDesc.setText(String.valueOf(mList.get(position).getDescricao()));
    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    class MyViewPager extends RecyclerView.ViewHolder {

        TextView txtData, txtDesc, txtTipo;

        MyViewPager(View itemView) {
            super(itemView);
            txtData = itemView.findViewById(R.id.txt_data);
            txtTipo = itemView.findViewById(R.id.txt_tipo);
            txtDesc = itemView.findViewById(R.id.txt_descricao);
        }
    }
}
