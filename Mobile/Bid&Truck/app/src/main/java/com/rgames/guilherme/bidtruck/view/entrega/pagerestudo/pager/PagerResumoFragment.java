package com.rgames.guilherme.bidtruck.view.entrega.pagerestudo.pager;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rgames.guilherme.bidtruck.R;

public class PagerResumoFragment extends Fragment {

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
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_pager_resumo, container, false);
    }
}
