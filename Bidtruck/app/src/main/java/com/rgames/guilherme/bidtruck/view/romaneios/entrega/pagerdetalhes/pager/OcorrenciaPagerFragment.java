package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;


import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.ocorrencia.OcorrenciaActivity;

import java.util.List;

public class OcorrenciaPagerFragment extends Fragment {

    private static final String ARG_PARAM1 = "param1";
    private Romaneio mRomaneio;
    private View mView;


    public OcorrenciaPagerFragment() {
        // Required empty public constructor
    }

    public static OcorrenciaPagerFragment newInstance(Romaneio romaneio) {
        OcorrenciaPagerFragment fragment = new OcorrenciaPagerFragment();
        Bundle args = new Bundle();
        args.putParcelable(ARG_PARAM1, romaneio);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mRomaneio = getArguments().getParcelable(ARG_PARAM1);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_ocorrencia_pager, container, false);
    }

    @Override
    public void onResume() {
        super.onResume();
        initList();
    }

    private void initList() {
//        mView.findViewById(R.id.btn_occurrence).setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent intent = new Intent(getActivity(), OcorrenciaActivity.class);
//                Bundle bundle = new Bundle();
//                bundle.putParcelable(Entrega.PARCEL, mEntrega);
//                startActivity(intent.putExtras(bundle));
//            }
//        });
    }

    private void initRecyclerView(List<Ocorrencia> ocorrenciaList) {
        RecyclerView recyclerView = mView.findViewById(R.id.recyclerview);
        recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
        recyclerView.setAdapter(new AdapterRecyclerOcorrencia(ocorrenciaList));
    }
}
