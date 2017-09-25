package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.Manifest;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.Fragment;
import android.text.Html;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.PolylineOptions;
import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;

public class RotaPagerFragment extends SupportMapFragment implements OnMapReadyCallback {

    private final static String ARG_1 = "arg_1";
    private View mView;
    private Entrega mEntrega;
    private GoogleMap mMap;
    private Marker marker;

    public RotaPagerFragment() {
    }

    public static RotaPagerFragment newInstance(Entrega entrega) {
        RotaPagerFragment fragment = new RotaPagerFragment();
        Bundle bundle = new Bundle();
        bundle.putParcelable(ARG_1, entrega);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getMapAsync(this);
        if (getArguments() != null) {
            mEntrega = getArguments().getParcelable(ARG_1);
        }
    }

    @Override
    public void onResume() {
        super.onResume();
    }

    //    @Override
//    public View onCreateView(LayoutInflater inflater, ViewGroup container,
//                             Bundle savedInstanceState) {
//        return mView = inflater.inflate(R.layout.fragment_rota_pager, container, false);
//    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        mMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);
        addMarker(new LatLng(-23.564224, -46.653156), "Primeiro", "Marcador 1");
        CameraPosition cameraPosition = new CameraPosition.Builder().target(marker.getPosition()).zoom(20).bearing(0).tilt(50).build();
        mMap.moveCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));
        LatLng latLng = new LatLng(-23.564224, -46.653156);
        LatLng latLng1 = new LatLng(-23.564350, -46.653500);
        mMap.addPolyline(new PolylineOptions().add(latLng, latLng1).width(10).color(Color.RED));

        

        mMap.setOnMapClickListener(new GoogleMap.OnMapClickListener() {
            @Override
            public void onMapClick(LatLng latLng) {
                Log.i("teste", "setOnMapClickListener()");
            }
        });

        mMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
            @Override
            public boolean onMarkerClick(Marker marker) {
                Log.i("teste", "setOnMarkerClickListener() / Marker: " + marker.getTitle());
                return false;
            }
        });

        mMap.setOnInfoWindowClickListener(new GoogleMap.OnInfoWindowClickListener() {
            @Override
            public void onInfoWindowClick(Marker marker) {
                Log.i("teste", "setOnInfoWindowClickListener() / Marker: " + marker.getTitle());
            }
        });

        mMap.setInfoWindowAdapter(new GoogleMap.InfoWindowAdapter() {

            //Altera toda a janela (TUTÔ!!) e sobreescreve o InfoContent
            @Override
            public View getInfoWindow(Marker marker) {
                return null;
            }

            //Altera toda a janela e mantem o balao
            @Override
            public View getInfoContents(Marker marker) {
                TextView textView = new TextView(getActivity());
                textView.setText(Html.fromHtml("<b><font color=#F44336>" + marker.getTitle() + "</font>"
                        + marker.getSnippet() + "</b>"));
                return null;
            }
        });
    }

    private void addMarker(LatLng latLng, String title, String snippet) {
        MarkerOptions options = new MarkerOptions();
        options.position(latLng);
        options.title(title);
        options.snippet(snippet);
        //pra poder mexer ele com clique
        options.draggable(false);
        marker = mMap.addMarker(options);
    }
}
