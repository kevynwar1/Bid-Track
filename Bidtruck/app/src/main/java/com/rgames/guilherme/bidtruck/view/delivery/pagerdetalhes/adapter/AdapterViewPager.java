package com.rgames.guilherme.bidtruck.view.delivery.pagerdetalhes.adapter;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;
import com.rgames.guilherme.bidtruck.view.delivery.pagerdetalhes.pager.DestinoPagerkFragment;
import com.rgames.guilherme.bidtruck.view.delivery.pagerdetalhes.pager.RotaPagerFragment;

public class AdapterViewPager extends FragmentStatePagerAdapter {
    private String[] mTitles;
    private int COUNT = 2;
    private Delivery mDelivery;

    public AdapterViewPager(FragmentManager fm, Context context, Delivery delivery) {
        super(fm);
        mDelivery = delivery;
        mTitles = context.getResources().getStringArray(R.array.app_tablayout_entrega_detalhes);
    }

    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return DestinoPagerkFragment.newInstance(mDelivery);
            case 1:
                return RotaPagerFragment.newInstance(mDelivery);
            default:
                return DestinoPagerkFragment.newInstance(mDelivery);
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
