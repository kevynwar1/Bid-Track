package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;


import android.content.Intent;
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
import android.widget.LinearLayout;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
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
    private Romaneio mRomaneio;
    private View mView;
    private FloatingActionButton fab_photo;
    private RecyclerView rv;

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
        return mView = inflater.inflate(R.layout.content_occurrence, container, false);
    }

    @Override
    public void onResume() {
        super.onResume();
        initList();
        clickfloat();
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
        fab_photo = (FloatingActionButton) mView.findViewById(R.id.fab_photo);
        rv = (RecyclerView) mView.findViewById(R.id.rv_photo);
    }

    private void initRecyclerView(List<Ocorrencia> ocorrenciaList) {
        RecyclerView recyclerView = mView.findViewById(R.id.recyclerview);
        recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
        recyclerView.setAdapter(new AdapterRecyclerOcorrencia(ocorrenciaList));
    }

    private void clickfloat() {
        fab_photo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity(), MultiCameraActivity.class);
                Params params = new Params();
                params.setCaptureLimit(10);
                intent.putExtra(Constants.KEY_PARAMS, params);
                startActivityForResult(intent, Constants.TYPE_MULTI_CAPTURE);
            }
        });
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode != RESULT_OK) {
            return;
        }
        switch (requestCode) {
            case Constants.TYPE_MULTI_CAPTURE:
                handleResponseIntent(data);
                break;

        }
    }

    private int getColumnCount() {
        DisplayMetrics displayMetrics = getResources().getDisplayMetrics();
        float dpWidth = displayMetrics.widthPixels / displayMetrics.density;
        float thumbnailDpWidth = getResources().getDimension(R.dimen.thumbnail_width) / displayMetrics.density;
        return (int) (dpWidth / thumbnailDpWidth);
    }

    private void handleResponseIntent(Intent intent) {
        ArrayList<Image> imagesList = intent.getParcelableArrayListExtra(Constants.KEY_BUNDLE_LIST);
        rv.setHasFixedSize(true);
        StaggeredGridLayoutManager mLayoutManager = new StaggeredGridLayoutManager(getColumnCount(), GridLayoutManager.VERTICAL);
        mLayoutManager.setGapStrategy(StaggeredGridLayoutManager.GAP_HANDLING_MOVE_ITEMS_BETWEEN_SPANS);
        rv.setLayoutManager(mLayoutManager);
        GalleryImagesAdapter imageAdapter = new GalleryImagesAdapter(getActivity(), imagesList, getColumnCount(), new Params());
        rv.setAdapter(imageAdapter);
    }

}
