package com.rgames.guilherme.bidtruck.view.fotos.adapters;

import android.content.Context;
import android.graphics.Bitmap;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Kevyn on 24/10/2017.
 */

public class ImagemAdapter extends RecyclerView.Adapter<ImagemAdapter.MyViewHolder> {

    private List<Image> mRomaneioList;
    private Context mContext;

    public ImagemAdapter(Context context, List<Image> romaneioList) {
        this.mRomaneioList = romaneioList;
        this.mContext = context;
    }
    @Override
    public ImagemAdapter.MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        return new MyViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.image_item, parent, false));
    }
    @Override
    public void onBindViewHolder(final ImagemAdapter.MyViewHolder holder, int position) {
        try {

            for (int i = 0; i< mRomaneioList.size(); i++){
                String entity = mRomaneioList.get(i).getImagePath();
                Bitmap bit = CarregadorDeFoto.carrega(entity);
                holder.imageView.setImageBitmap(bit);
            }

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

        ImageView imageView;

        public MyViewHolder(View itemView) {
            super(itemView);
            imageView = itemView.findViewById(R.id.imageView);

        }
    }
}
