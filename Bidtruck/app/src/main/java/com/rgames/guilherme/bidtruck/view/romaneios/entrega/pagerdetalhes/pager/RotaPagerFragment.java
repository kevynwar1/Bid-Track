package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.text.Html;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.maps.model.PolylineOptions;
import com.rgames.guilherme.bidtruck.model.basic.DirectionFinder;
import com.rgames.guilherme.bidtruck.model.basic.DirectionFinderListener;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.Route;

import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

public class RotaPagerFragment extends SupportMapFragment implements OnMapReadyCallback, DirectionFinderListener {

    private final static String ARG_1 = "arg_1";
    private final static String ARG_2 = "arg_2";
    private final static String ARG_3 = "arg_3";
    private View mView;
    private Entrega mEntrega;
    private GoogleMap mMap;
    private List<Marker> originMarkers = new ArrayList<>();
    private List<Marker> destinationMarkers = new ArrayList<>();
    private List<Polyline> polylinePaths = new ArrayList<>();
    private ProgressDialog progressDialog;
    private double latEmpresa, longEmpresa;

    public RotaPagerFragment() {
    }

    public static RotaPagerFragment newInstance(double latEmpresa, double longEmpresa, Entrega entrega) {
        RotaPagerFragment fragment = new RotaPagerFragment();
        Bundle bundle = new Bundle();
        bundle.putParcelable(ARG_1, entrega);
        bundle.putDouble(ARG_2, latEmpresa);
        bundle.putDouble(ARG_3, longEmpresa);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getMapAsync(this);
        if (getArguments() != null) {
            mEntrega = getArguments().getParcelable(ARG_1);
            latEmpresa = getArguments().getDouble(ARG_2);
            longEmpresa = getArguments().getDouble(ARG_3);
        }
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        if (ActivityCompat.checkSelfPermission(getActivity(), Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(getActivity(), Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            requestPermissions(new String[]{android.Manifest.permission.ACCESS_FINE_LOCATION}, 1);
            requestPermissions(new String[]{android.Manifest.permission.ACCESS_COARSE_LOCATION}, 1);
            return;
        }
        mMap.setMyLocationEnabled(true);
//        mMap = googleMap;
//        mMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);
//        addMarker(new LatLng(-23.564224, -46.653156), "Primeiro", "Marcador 1");
//        CameraPosition cameraPosition = new CameraPosition.Builder().target(marker.getPosition()).zoom(20).bearing(0).tilt(50).build();
//        mMap.moveCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));
//        LatLng latLng = new LatLng(-23.564224, -46.653156);
//        LatLng latLng1 = new LatLng(-23.564350, -46.653500);
//        mMap.addPolyline(new PolylineOptions().add(latLng, latLng1).width(10).color(Color.RED));


//        mMap.setOnMapClickListener(new GoogleMap.OnMapClickListener() {
//            @Override
//            public void onMapClick(LatLng latLng) {
//                Log.i("teste", "setOnMapClickListener()");
//            }
//        });
//
//        mMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
//            @Override
//            public boolean onMarkerClick(Marker marker) {
//                Log.i("teste", "setOnMarkerClickListener() / Marker: " + marker.getTitle());
//                return false;
//            }
//        });
//
//        mMap.setOnInfoWindowClickListener(new GoogleMap.OnInfoWindowClickListener() {
//            @Override
//            public void onInfoWindowClick(Marker marker) {
//                Log.i("teste", "setOnInfoWindowClickListener() / Marker: " + marker.getTitle());
//            }
//        });
//
//        mMap.setInfoWindowAdapter(new GoogleMap.InfoWindowAdapter() {
//
//            //Altera toda a janela (TUTÔ!!) e sobreescreve o InfoContent
//            @Override
//            public View getInfoWindow(Marker marker) {
//                return null;
//            }
//
//            //Altera toda a janela e mantem o balao
//            @Override
//            public View getInfoContents(Marker marker) {
//                TextView textView = new TextView(getActivity());
//                textView.setText(Html.fromHtml("<b><font color=#F44336>" + marker.getTitle() + "</font>"
//                        + marker.getSnippet() + "</b>"));
//                return textView;
//            }
//        });
        sendRequest();
    }

    private void sendRequest() {
        try {
            //vou deixar esses valores pq eles sao proximos e qualquer coisa eu testo com eles.
            String origin = "-23.564224, -46.653156";
            origin = latEmpresa + ", " + longEmpresa;
            String destination = "-23.654500, -46.653500";
            destination = mEntrega.getDestinatario().getLatitude() + ", " + mEntrega.getDestinatario().getLongitude();
            if (origin.isEmpty()) {
                Toast.makeText(getActivity(), "Please enter origin address!", Toast.LENGTH_SHORT).show();
                return;
            }
            if (destination.isEmpty()) {
                Toast.makeText(getActivity(), "Please enter destination address!", Toast.LENGTH_SHORT).show();
                return;
            }

            new DirectionFinder(this, origin, destination).execute();
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

//    private void addMarker(LatLng latLng, String title, String snippet) {
//        MarkerOptions options = new MarkerOptions();
//        options.position(latLng);
//        options.title(title);
//        options.snippet(snippet);
//        //pra poder mexer ele com clique
//        options.draggable(false);
//        marker = mMap.addMarker(options);
//    }

    @Override
    public void onDirectionFinderStart() {
        progressDialog = ProgressDialog.show(getActivity(), "Please wait.",
                "Finding direction..!", true);
        if (originMarkers != null) {
            for (Marker marker : originMarkers) {
                marker.remove();
            }
        }

        if (destinationMarkers != null) {
            for (Marker marker : destinationMarkers) {
                marker.remove();
            }
        }

        if (polylinePaths != null) {
            for (Polyline polyline : polylinePaths) {
                polyline.remove();
            }
        }
    }

    @Override
    public void onDirectionFinderSuccess(List<Route> routes) {
        progressDialog.dismiss();
        polylinePaths = new ArrayList<>();
        originMarkers = new ArrayList<>();
        destinationMarkers = new ArrayList<>();

        for (Route route : routes) {
            mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(route.startLocation, 12));
//            ((TextView) getActivity().findViewById(R.id.tvDuration)).setText(route.duration.text);
//            ((TextView) getActivity().findViewById(R.id.tvDistance)).setText(route.distance.text);

            originMarkers.add(mMap.addMarker(new MarkerOptions()
//                    .icon(BitmapDescriptorFactory.fromResource(R.drawable.start_blue))
                    .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_GREEN))
                    .title(route.startAddress)
                    .position(route.startLocation)));
            destinationMarkers.add(mMap.addMarker(new MarkerOptions()
                    .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_ORANGE))
//                    .icon(BitmapDescriptorFactory.fromResource(R.drawable.end_green))
                    .title(route.endAddress)
                    .position(route.endLocation)));

            PolylineOptions polylineOptions = new PolylineOptions().
                    geodesic(true).
                    color(Color.BLUE).
                    width(10);

            for (int i = 0; i < route.points.size(); i++)
                polylineOptions.add(route.points.get(i));

            polylinePaths.add(mMap.addPolyline(polylineOptions));
        }
    }
}
