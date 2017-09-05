package com.rgames.guilherme.bidtruck.model.basic;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Guilherme on 04/09/2017.
 */

public class InitBasic {

    private List<Delivery> mListDeliveries;

    public InitBasic() {
        mListDeliveries = new ArrayList<>();
    }

    public void addListDelivery(String titulo) {
        mListDeliveries.add(new Delivery(
                0, titulo
                , new Romaneio(0, new ArrayList<Delivery>(), 's', false)
                , new Addressee(0)
                , new StatusDelivery(0, new ArrayList<Delivery>(), new Occurrence(0, new ArrayList<StatusDelivery>(), new TypeOccurrence(0, "", 's'), "", 's'), null)
                , 0f, null, false));
    }

    public List<Delivery> getListDelivery() {
        return mListDeliveries;
    }
}
