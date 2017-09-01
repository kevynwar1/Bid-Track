package com.rgames.guilherme.bidtruck.view.delivery.pagerdetalhes.pager;

import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;

public class DestinoPagerkFragment extends Fragment {

    private final static String ARG_1 = "arg_1";
    private Delivery mDelivery;
    private View mView;

    public DestinoPagerkFragment() {
    }

    public static DestinoPagerkFragment newInstance(Delivery delivery) {
        DestinoPagerkFragment fragment = new DestinoPagerkFragment();
        Bundle bundle = new Bundle();
        bundle.putParcelable(ARG_1, delivery);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mDelivery = getArguments().getParcelable(ARG_1);
        } else mDelivery = new Delivery();
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_destino_pagerk, container, false);
    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            initViews();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void initViews() throws Exception {
        if (mView != null) {
            ((TextView) mView.findViewById(R.id.txt_entrega)).setText(mDelivery.getTitulo());
            mView.findViewById(R.id.btn_confirm).setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    final AlertDialog alertDialog = new AlertDialog.Builder(getActivity()).create();
                    alertDialog.setTitle(getString(R.string.app_name));
                    alertDialog.setMessage("Deseja confirmar a entrega?");
                    alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE
                            , getString(R.string.app_dlg_cancel)
                            , new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {
                                    dialogInterface.dismiss();
                                }
                            });
                    alertDialog.setButton(AlertDialog.BUTTON_POSITIVE
                            , getString(R.string.app_dlg_confirm)
                            , new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {
                                    Toast.makeText(getActivity(), "CONFIRMADA!", Toast.LENGTH_SHORT).show();
                                    dialogInterface.dismiss();
                                }
                            });
                    alertDialog.show();
                }
            });
        } else throw new NullPointerException("View nula");
    }
}
