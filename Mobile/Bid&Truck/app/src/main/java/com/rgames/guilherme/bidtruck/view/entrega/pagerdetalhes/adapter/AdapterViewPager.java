package com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.adapter;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager.DestinoPagerkFragment;
import com.rgames.guilherme.bidtruck.view.entrega.pagerdetalhes.pager.RotaPagerFragment;

public class AdapterViewPager extends FragmentStatePagerAdapter {
    private String[] mTitles;
    private int COUNT = 2;

    public AdapterViewPager(FragmentManager fm, Context context) {
        super(fm);
        mTitles = context.getResources().getStringArray(R.array.app_tablayout_entrega_detalhes);
    }

    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return DestinoPagerkFragment.newInstance();
            case 1:
                return RotaPagerFragment.newInstance();
            default:
                return DestinoPagerkFragment.newInstance();
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
