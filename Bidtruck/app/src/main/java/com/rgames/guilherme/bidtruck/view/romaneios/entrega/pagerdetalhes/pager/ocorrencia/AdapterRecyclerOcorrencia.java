package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.ocorrencia;

import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.view.ViewGroup;

import com.rgames.guilherme.bidtruck.model.basic.InitBasic;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;

import java.util.List;

/**
 * Created by Guilherme on 05/09/2017.
 */

public class AdapterRecyclerOcorrencia extends RecyclerView.Adapter<AdapterRecyclerOcorrencia.MyViewPager> {

    private List<Ocorrencia> mList;

    public AdapterRecyclerOcorrencia(){
        InitBasic initBasic = new InitBasic();
        mList = initBasic.getListOccurrence();
    }

    @Override
    public MyViewPager onCreateViewHolder(ViewGroup parent, int viewType) {
        return null;
    }

    @Override
    public void onBindViewHolder(MyViewPager holder, int position) {

    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public class MyViewPager extends RecyclerView.ViewHolder{

        public MyViewPager(View itemView) {
            super(itemView);
        }
    }
}
