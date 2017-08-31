package com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.adapter;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager.DestinoPagerkFragment;
import com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager.RotaPagerFragment;

public class AdapterViewPager extends FragmentStatePagerAdapter {
    private String[] mTitles;
    private int COUNT = 2;
    private Entrega mEntrega;

    public AdapterViewPager(FragmentManager fm, Context context, Entrega entrega) {
        super(fm);
        mEntrega = entrega;
        mTitles = context.getResources().getStringArray(R.array.app_tablayout_entrega_detalhes);
    }

    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return DestinoPagerkFragment.newInstance(mEntrega);
            case 1:
                return RotaPagerFragment.newInstance(mEntrega);
            default:
                return DestinoPagerkFragment.newInstance(mEntrega);
        }
    }

    @Override
    public int getCount() {
        return COUNT;
    }

    @Override
    public CharSequence getPageTitle(int position) {
        return mTitles[position];
    }
}
