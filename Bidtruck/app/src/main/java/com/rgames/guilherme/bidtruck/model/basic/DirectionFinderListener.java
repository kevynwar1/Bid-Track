package com.rgames.guilherme.bidtruck.model.basic;

import java.util.List;

/**
 * Created by Guilherme on 25/09/2017.
 */

public interface DirectionFinderListener {
    void onDirectionFinderStart();
    void onDirectionFinderSuccess(List<Route> route);
}
