package com.rgames.guilherme.bidtruck.view.home;


import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;

public class HomeFragment extends Fragment {

    private View mView;
    private MyProgressBar myProgressBar;

    public HomeFragment() {
    }

    public static HomeFragment newInstance() {
        return new HomeFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        try {
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setSubtitle(
                        getActivity().getResources().getString(R.string.app_title_home));
        } catch (NullPointerException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onResume() {
        super.onResume();
        initList();
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_home, container, false);
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

    private void initList() {
        new AsyncTask<Void, Void, Void>() {
            @Override
            protected void onPreExecute() {
                try {
                    initProgressBar();
                } catch (Exception e) {
                    //sem tratamento, so na maciota por enquanto.
                    e.printStackTrace();
                }
            }

            @Override
            protected Void doInBackground(Void... voids) {
                return null;
            }

            @Override
            protected void onPostExecute(Void aVoid) {
                try {
                    initRecyclerView();
                    finishProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }

    private void initRecyclerView() throws Exception {
        RecyclerView r = mView.findViewById(R.id.recyclerview);
        if (getActivity() != null)
            r.setLayoutManager(new LinearLayoutManager(getActivity()));
        else
            throw new NullPointerException("Context nulo");
        r.setAdapter(new AdapterRecyclerHome(null));
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

