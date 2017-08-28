package com.rgames.guilherme.bidtruck.model.basic;

import android.view.LayoutInflater;
import android.view.View;
import android.widget.FrameLayout;
import android.widget.ProgressBar;

import com.rgames.guilherme.bidtruck.R;

public class MyProgressBar {

    private boolean mActive;
    private ProgressBar mProgressBar;
    private FrameLayout mFrameLayout;

    public MyProgressBar(FrameLayout frameLayout) {
        try {
            mFrameLayout = frameLayout;
            mFrameLayout.removeAllViews();
            mFrameLayout.addView(initNewProgressBar());
            mFrameLayout.setVisibility(View.VISIBLE);
            mFrameLayout.invalidate();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private View initNewProgressBar() {
        setMActive(true);
        return mProgressBar = (ProgressBar) LayoutInflater.from(
                mFrameLayout.getContext()).inflate(R.layout.progress_bar, mFrameLayout, false);
    }

    public void onFinish() throws Exception {
        setMActive(false);
        if (mFrameLayout != null) {
            mFrameLayout.setVisibility(View.GONE);
            if (mProgressBar != null)
                mProgressBar.setVisibility(View.GONE);
            mProgressBar = null;
            mFrameLayout.removeAllViews();
            mFrameLayout = null;
        }
    }

    public boolean isMActive() {
        return mActive;
    }

    public void setMActive(boolean mActive) {
        this.mActive = mActive;
    }

}
