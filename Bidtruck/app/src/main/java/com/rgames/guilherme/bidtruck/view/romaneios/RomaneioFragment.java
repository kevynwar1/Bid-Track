package com.rgames.guilherme.bidtruck.view.romaneios;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.errors.MotoristaNaoConectadoException;

import java.util.List;

/**
 * Created by Guilherme on 05/09/2017.
 */

public class RomaneioFragment extends Fragment {

    private View mView;
    private MyProgressBar myProgressBar;
    private Facade mFacade;
    private Empresa empresa;
    private Motorista motorista;

    public RomaneioFragment() {
    }

    public static RomaneioFragment newInstance() {
        return new RomaneioFragment();
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        try {
            if (((AppCompatActivity) getActivity()).getSupportActionBar() != null)
                ((AppCompatActivity) getActivity()).getSupportActionBar().setTitle(
                        getActivity().getResources().getString(R.string.menu_drw_romaneio));
            ((AppCompatActivity) getActivity()).getSupportActionBar().setDisplayShowTitleEnabled(true);
        } catch (NullPointerException e) {
            e.printStackTrace();
        }


    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            mFacade = new Facade(getActivity());
            if (!mFacade.isConnected(getActivity())) {
                Toast.makeText(getActivity(), getString(R.string.app_err_exc_semConexao), Toast.LENGTH_LONG).show();
                emptyView(true);
            } else
                init();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup
            container, @Nullable Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_romaneio, container, false);
    }

    private void init(){
        new AsyncTask<Void, Void, List<Romaneio>>() {
            @Override
            protected void onPreExecute() {
                try {
                    initProgressBar();
                    emptyView(false);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            protected List<Romaneio> doInBackground(Void... voids) {
                try {
                    return mFacade.selectRomaneio(mFacade.isLogged());
                } catch (MotoristaNaoConectadoException e) {
                    e.printStackTrace();
                    return null;
                }
            }

            @Override
            protected void onPostExecute(List<Romaneio> romaneios) {
                try {
                    if (romaneios == null)
                        emptyView(true);
                    else
                        initRecyclerView(romaneios);
                    finishProgressBar();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }

    private void emptyView(boolean isVisible) {
        mView.findViewById(R.id.txt_empty).setVisibility((isVisible) ? View.VISIBLE : View.GONE);
    }

    private void initRecyclerView(List<Romaneio> list) throws Exception {
        if (mView != null && getActivity() != null) {
            RecyclerView r = mView.findViewById(R.id.recyclerview);
            r.setLayoutManager(new LinearLayoutManager(getActivity()));
            r.setAdapter(new AdapterRecyclerRomaneio(getActivity(), list));
        } else throw new NullPointerException("View/Contexto Nulo");
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
