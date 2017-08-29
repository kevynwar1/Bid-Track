package com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rgames.guilherme.bidtruck.R;

public class RotaPagerFragment extends Fragment {
    private View mView;

    public RotaPagerFragment() {
    }
    public static RotaPagerFragment newInstance() {
        return new RotaPagerFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_rota_pager, container, false);
    }
}
