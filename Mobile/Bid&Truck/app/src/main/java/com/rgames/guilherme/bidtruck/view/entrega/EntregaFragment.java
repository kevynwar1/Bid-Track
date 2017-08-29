package com.rgames.guilherme.bidtruck.view.entrega;


import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.app.Fragment;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.view.entrega.pagerestudo.adapter.AdapterViewPager;

public class EntregaFragment extends Fragment {

    private View mView;
    private MyProgressBar myProgressBar;
    private TabLayout mTabLayout;
    private ViewPager mVewPager;

    public EntregaFragment() {
    }

    public static EntregaFragment newInstance() {
        return new EntregaFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        try {
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle(
                        getActivity().getResources().getString(R.string.menu_drw_entrega));
            ((AppCompatActivity) getActivity()).getSupportActionBar().setDisplayShowTitleEnabled(true);
        } catch (NullPointerException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            initViewPager();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_entrega, container, false);
    }

    @Override
    public void onPause() {
        super.onPause();
        try {
            finishProgressBar();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onStop() {
        super.onStop();
        mVewPager = null;
    }

    private void initViewPager() throws Exception {
        if (getActivity() != null) {
            mVewPager = mView.findViewById(R.id.viewpager);
            mVewPager.setAdapter(new AdapterViewPager(getChildFragmentManager(), getActivity()));
            mTabLayout = mView.findViewById(R.id.tablayout);
            mTabLayout.post(new Runnable() {
                @Override
                public void run() {
                    mTabLayout.setupWithViewPager(mVewPager);
                }
            });
        } else throw new NullPointerException("Contexto nulo.");
    }

    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (myProgressBar == null)
            myProgressBar = new MyProgressBar((FrameLayout) mView.findViewById(R.id.frame_progress));
    }

    private void finishProgressBar() throws Exception {
        if (myProgressBar != null) {
            myProgressBar.onFinish();
        }
    }
}

