package com.rgames.guilherme.bidtruck.view.home;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rgames.guilherme.bidtruck.R;

import java.util.ArrayList;
import java.util.List;

public class AdapterRecyclerHome extends RecyclerView.Adapter<AdapterRecyclerHome.MyViewHolder> {

    private List<Object> mList;

    public AdapterRecyclerHome(List<Object> list) {
        mList = (list != null) ? list : new ArrayList<>();
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.adapter_recycler_home, parent, false));
    }

    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {

    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {

        public MyViewHolder(View itemView) {
            super(itemView);
        }
    }
}
