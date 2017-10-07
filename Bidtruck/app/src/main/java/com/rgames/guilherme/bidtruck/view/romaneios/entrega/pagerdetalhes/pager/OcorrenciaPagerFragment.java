package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.app.Fragment;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.StaggeredGridLayoutManager;
import android.util.DisplayMetrics;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.controller.ControllerOcorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.errors.EntregaNullException;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.ocorrencia.OcorrenciaActivity;
import com.vlk.multimager.activities.MultiCameraActivity;
import com.vlk.multimager.adapters.GalleryImagesAdapter;
import com.vlk.multimager.utils.Constants;
import com.vlk.multimager.utils.Image;
import com.vlk.multimager.utils.Params;

import java.util.ArrayList;
import java.util.List;

import static android.app.Activity.RESULT_OK;

public class OcorrenciaPagerFragment extends Fragment {

    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM12 = "param2";
    private int seq_entrega;
    private int romaneio;
    private View mView;
    private MyProgressBar myProgressBar;
    private ControllerOcorrencia controllerOcorrencia;

    public OcorrenciaPagerFragment() {
        // Required empty public constructor
    }

    public static OcorrenciaPagerFragment newInstance(int seq_entrega, int romaneio) {
        OcorrenciaPagerFragment fragment = new OcorrenciaPagerFragment();
        Bundle args = new Bundle();
        args.putInt(ARG_PARAM1, seq_entrega);
        args.putInt(ARG_PARAM12, romaneio);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            seq_entrega = getArguments().getInt(ARG_PARAM1);
            romaneio = getArguments().getInt(ARG_PARAM12);
        }
        controllerOcorrencia = new ControllerOcorrencia();
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_ocorrencia_pager, container, false);
    }

    @Override
    public void onResume() {
        super.onResume();
        initButton();
        initList();
    }

    private void initButton() {
        mView.findViewById(R.id.fabNew).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity(), OcorrenciaActivity.class);
                Bundle bundle = new Bundle();
                bundle.putInt(Entrega.PARCEL, seq_entrega);
                bundle.putInt(Romaneio.PARCEL, romaneio);
                startActivity(intent.putExtras(bundle));
            }
        });
    }

    private void initList() {
        new AsyncTask<Void, Void, List<Ocorrencia>>() {
            String msg = "";

            @Override
            protected void onPreExecute() {
                initProgressBar();
                initEmpty(false);
            }

            @Override
            protected List<Ocorrencia> doInBackground(Void... voids) {
                try {
                    return controllerOcorrencia.select(seq_entrega, romaneio);
                } catch (EntregaNullException e) {
                    e.printStackTrace();
                    msg = e.getMessage();
                    return null;
                }
            }

            @Override
            protected void onPostExecute(List<Ocorrencia> ocorrencias) {
                try {
                    if (ocorrencias != null && ocorrencias.size() > 0) {
                        initRecyclerView(ocorrencias);
                    } else {
                        initEmpty(true);
                    }
                    finishProgressBar();
                    if (!msg.isEmpty())
                        Toast.makeText(getActivity(), msg, Toast.LENGTH_LONG).show();
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.execute();
    }

    private void initEmpty(boolean b) {
        mView.findViewById(R.id.txt_empty).setVisibility((b) ? View.VISIBLE : View.GONE);
    }

    private void initRecyclerView(List<Ocorrencia> ocorrenciaList) {
        RecyclerView recyclerView = mView.findViewById(R.id.recyclerview);
        recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
        recyclerView.setAdapter(new AdapterRecyclerOcorrencia(ocorrenciaList));
    }

    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (myProgressBar == null)
            myProgressBar = new MyProgressBar((FrameLayout) getActivity().findViewById(R.id.frame_progress));
    }

    private void finishProgressBar() throws Exception {
        if (myProgressBar != null) {
            myProgressBar.onFinish();
        }
    }
}
