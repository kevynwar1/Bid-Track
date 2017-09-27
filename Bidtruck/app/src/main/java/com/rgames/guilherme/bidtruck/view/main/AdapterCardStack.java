package com.rgames.guilherme.bidtruck.view.main;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

/**
 * Created by Guilherme on 27/09/2017.
 */

public class AdapterCardStack extends FragmentStatePagerAdapter{

    private Context mContext;
    private boolean isLogin;

    public AdapterCardStack(FragmentManager fm, Context context, boolean isLogin) {
        super(fm);
        this.isLogin = isLogin;
        mContext = context;
    }

    @Override
    public Fragment getItem(int position) {
        if(position == 0){
            LoginCardStackFragment login = LoginCardStackFragment.newInstance(isLogin);
            login.setListener((IGoToEmpresa) mContext);
            return login;
        }else if(position == 1){
            return EmpresaCardStackFragment.newInstance();
        }else{
            LoginCardStackFragment login = LoginCardStackFragment.newInstance(isLogin);
            login.setListener((IGoToEmpresa) mContext);
            return login;
        }
    }

    @Override
    public int getCount() {
        return 2;
    }
}
