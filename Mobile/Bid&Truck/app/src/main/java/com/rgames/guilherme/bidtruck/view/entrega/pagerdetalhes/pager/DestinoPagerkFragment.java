package com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager;

import android.content.Context;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rgames.guilherme.bidtruck.R;

public class DestinoPagerkFragment extends Fragment {
    private View mView;

    public DestinoPagerkFragment() {
    }

    public static DestinoPagerkFragment newInstance() {
        return new DestinoPagerkFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_destino_pagerk, container, false);
    }
}
