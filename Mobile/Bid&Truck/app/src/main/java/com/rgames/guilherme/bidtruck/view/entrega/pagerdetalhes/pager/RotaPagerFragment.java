package com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;

public class RotaPagerFragment extends Fragment {

    private final static String ARG_1 = "arg_1";
    private View mView;
    private Entrega mEntrega;

    public RotaPagerFragment() {
    }

    public static RotaPagerFragment newInstance(Entrega entrega) {
        RotaPagerFragment fragment = new RotaPagerFragment();
        Bundle bundle = new Bundle();
        bundle.putParcelable(ARG_1, entrega);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mEntrega = getArguments().getParcelable(ARG_1);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_rota_pager, container, false);
    }
}
