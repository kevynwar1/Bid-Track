package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.AnimationUtils;
import android.view.animation.LayoutAnimationController;
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

import java.util.List;

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
        controllerOcorrencia = new ControllerOcorrencia(getActivity());
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

    @SuppressLint("StaticFieldLeak")
    private void initList() {
        new AsyncTask<Void, Void, List<Ocorrencia>>() {
            @Override
            protected void onPreExecute() {
                initProgressBar();
                initEmpty(false);
            }

            @Override
            protected List<Ocorrencia> doInBackground(Void... voids) {
                try {
                    return controllerOcorrencia.select(seq_entrega, romaneio);
                } catch (final EntregaNullException e) {
                    e.printStackTrace();
                    getActivity().runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            try {
                                finishProgressBar();
                            } catch (Exception e1) {
                                e1.printStackTrace();
                            }
                            Toast.makeText(getActivity(), e.getMessage(), Toast.LENGTH_LONG).show();
                        }
                    });
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
        LayoutAnimationController controller = AnimationUtils.loadLayoutAnimation(getActivity(), R.anim.list_layout);
        recyclerView.setLayoutAnimation(controller);
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
