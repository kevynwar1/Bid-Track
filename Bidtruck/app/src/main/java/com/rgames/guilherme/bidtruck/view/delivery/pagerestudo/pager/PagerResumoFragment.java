package com.rgames.guilherme.bidtruck.view.delivery.pagerestudo.pager;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;
import com.rgames.guilherme.bidtruck.model.basic.InitBasic;

import java.util.List;

public class PagerResumoFragment extends Fragment {

    private InitBasic mInitBasic;
    private List<Delivery> mListDeliveries;
    private View mView;

    public PagerResumoFragment() {
    }

    public static PagerResumoFragment newInstance() {
        return new PagerResumoFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            initDeliveries();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_pager_resumo, container, false);
    }

    private void initDeliveries() throws Exception{
        mInitBasic = new InitBasic();
        mInitBasic.addListDelivery("Nova entrega");
        mInitBasic.addListDelivery("Entrega 2");
        mListDeliveries = mInitBasic.getListDelivery();
    }
}
