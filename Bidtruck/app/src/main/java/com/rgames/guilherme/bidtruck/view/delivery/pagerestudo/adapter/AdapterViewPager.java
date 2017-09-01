package com.rgames.guilherme.bidtruck.view.delivery.pagerestudo.adapter;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.view.delivery.pagerestudo.pager.PagerEntregaFragment;
import com.rgames.guilherme.bidtruck.view.delivery.pagerestudo.pager.PagerResumoFragment;

public class AdapterViewPager extends FragmentStatePagerAdapter {
    private int COUNT = 2;
    private String[] mTitlesVies;

    public AdapterViewPager(FragmentManager fm, Context context) {
        super(fm);
        mTitlesVies = context.getResources().getStringArray(R.array.app_tablayout_entrega);
    }

    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return PagerEntregaFragment.newInstance();
            case 1:
                return PagerResumoFragment.newInstance();
            default:
                return PagerEntregaFragment.newInstance();
        }
    }

    @Override
    public int getCount() {
        return COUNT;
    }

    @Override
    public CharSequence getPageTitle(int position) {
        return mTitlesVies[position];
    }
}
