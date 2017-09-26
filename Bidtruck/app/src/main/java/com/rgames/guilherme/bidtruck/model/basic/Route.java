package com.rgames.guilherme.bidtruck.model.basic;

import com.google.android.gms.maps.model.LatLng;

import java.util.List;

/**
 * Created by Guilherme on 25/09/2017.
 */

public class Route {
    public Distance distance;
    public Duration duration;
    public String endAddress;
    public LatLng endLocation;
    public String startAddress;
    public LatLng startLocation;

    public List<LatLng> points;
}
