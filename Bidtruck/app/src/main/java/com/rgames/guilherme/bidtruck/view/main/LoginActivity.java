package com.rgames.guilherme.bidtruck.view.main;

import android.content.Intent;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.FrameLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;

public class LoginActivity extends AppCompatActivity implements IGoToEmpresa {

    private MyProgressBar myProgressBar;
    private Facade mFacade;
    private ViewPager mViewPager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        initProgressBar();
        boolean isLog = verifyIsLogged();
        initViewPager(isLog);
        if (isLog)
            onGoToNext();
    }

    private void initViewPager(boolean isLogged) {
        mViewPager = (ViewPager) findViewById(R.id.viewpager);
        AdapterCardStack adapterCardStack = new AdapterCardStack(getSupportFragmentManager(), this, isLogged);
        mViewPager.setPageTransformer(true, new CardStackTransform());
        mViewPager.setOffscreenPageLimit(2);
        mViewPager.setAdapter(adapterCardStack);
    }

    @Override
    public void onGoToNext() {
        mViewPager.setCurrentItem(mViewPager.getCurrentItem() + 1);
    }

    private boolean verifyIsLogged() {
        mFacade = new Facade(LoginActivity.this);
        try {
            boolean chk = mFacade.isMatenhaConectado();
            Motorista motorista = mFacade.isLogged();
            return mFacade.isConnected(LoginActivity.this) && chk && (motorista != null && motorista.getCodigo() > 0);
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            try {
                finishProgressBar();
            } catch (Exception e1) {
                e1.printStackTrace();
            }
        }
        return false;
    }

    private void initMainActivity(Motorista motorista) throws Exception {
        Intent intent = new Intent(LoginActivity.this, MainActivity.class);
        Bundle bundle = new Bundle();
        bundle.putParcelable(Motorista.PARCEL_MOTORISTA, motorista);
        mFacade.setLogged(motorista);
        finishProgressBar();
        startActivity(intent.putExtras(bundle));
        finish();
    }

    @Override
    public void onBackPressed() {
        finish();
    }

    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (myProgressBar == null)
            myProgressBar = new MyProgressBar((FrameLayout) findViewById(R.id.frame_progress));
    }

    private void finishProgressBar() throws Exception {
        if (myProgressBar != null) {
            myProgressBar.onFinish();
        }
    }

    private class CardStackTransform implements ViewPager.PageTransformer {
        @Override
        public void transformPage(View page, float position) {
            if (position >= 0) {
                page.setScaleX(0.8f - 0.02f * position);
                page.setScaleY(0.8f);
                page.setTranslationX(-page.getWidth() * position);
                page.setTranslationY(30 * position);
            }
        }
    }
}
