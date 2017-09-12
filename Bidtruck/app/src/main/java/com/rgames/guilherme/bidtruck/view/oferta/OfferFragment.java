package com.rgames.guilherme.bidtruck.view.oferta;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.rgames.guilherme.bidtruck.R;

import java.util.ArrayList;
import java.util.List;

public class OfferFragment extends Fragment {

    private ArrayAdapter<String> adapterOffer;
    private ListView offerList;
    private List<String> offers;
    private String[] ofertas;

    public OfferFragment() {
        // Required empty public constructor
    }

    public static OfferFragment newInstance(){
        return new OfferFragment();
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_offer, container, false);
        offerList = (ListView) view.findViewById(R.id.listViewOffers);
        offers = new ArrayList<>();
        offers.add("Recife");
        offers.add("Olinda");
        offers.add("Jaboatão");
        adapterOffer = new ArrayAdapter<String>(getActivity(), android.R.layout.simple_list_item_1, android.R.id.text1, offers);
        offerList.setAdapter(adapterOffer);
        return view;
    }

}
