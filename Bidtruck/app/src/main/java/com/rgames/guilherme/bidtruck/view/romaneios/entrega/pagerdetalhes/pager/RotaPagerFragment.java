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
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.maps.model.PolylineOptions;
import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.DirectionFinder;
import com.rgames.guilherme.bidtruck.model.basic.DirectionFinderListener;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Route;

import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

public class RotaPagerFragment extends SupportMapFragment implements OnMapReadyCallback, DirectionFinderListener {

    private final static String ARG_1 = "arg_1";
    private View mView;
    private Entrega mEntrega;
    private GoogleMap mMap;
    private Marker marker;
    private List<Marker> originMarkers = new ArrayList<>();
    private List<Marker> destinationMarkers = new ArrayList<>();
    private List<Polyline> polylinePaths = new ArrayList<>();

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
        LatLng hcmus = new LatLng(10.762963, 106.682394);
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(hcmus, 18));
        originMarkers.add(mMap.addMarker(new MarkerOptions()
                .title("Đại học Khoa học tự nhiên")
                .position(hcmus)));

        if (ActivityCompat.checkSelfPermission(getActivity(), Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(getActivity(), Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        mMap.setMyLocationEnabled(true);
        sendRequest();
//        mMap = googleMap;
//        mMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);
//        addMarker(new LatLng(-23.564224, -46.653156), "Primeiro", "Marcador 1");
//        CameraPosition cameraPosition = new CameraPosition.Builder().target(marker.getPosition()).zoom(20).bearing(0).tilt(50).build();
//        mMap.moveCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));
//        LatLng latLng = new LatLng(-23.564224, -46.653156);
//        LatLng latLng1 = new LatLng(-23.564350, -46.653500);
//        mMap.addPolyline(new PolylineOptions().add(latLng, latLng1).width(10).color(Color.RED));


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

    private void sendRequest() {
        String origin = "-23.564224, -46.653156";
        String destination = "-23.564500, -46.653500";
        if (origin.isEmpty()) {
            Toast.makeText(getActivity(), "Please enter origin address!", Toast.LENGTH_SHORT).show();
            return;
        }
        if (destination.isEmpty()) {
            Toast.makeText(getActivity(), "Please enter destination address!", Toast.LENGTH_SHORT).show();
            return;
        }

        try {
            new DirectionFinder(this, origin, destination).execute();
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        }
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

    @Override
    public void onDirectionFinderStart() {
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
        polylinePaths = new ArrayList<>();
        originMarkers = new ArrayList<>();
        destinationMarkers = new ArrayList<>();

        for (Route route : routes) {
            mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(route.startLocation, 16));
//            ((TextView) getActivity().findViewById(R.id.tvDuration)).setText(route.duration.text);
//            ((TextView) getActivity().findViewById(R.id.tvDistance)).setText(route.distance.text);

            originMarkers.add(mMap.addMarker(new MarkerOptions()
//                    .icon(BitmapDescriptorFactory.fromResource(R.drawable.start_blue))
                    .title(route.startAddress)
                    .position(route.startLocation)));
            destinationMarkers.add(mMap.addMarker(new MarkerOptions()
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
