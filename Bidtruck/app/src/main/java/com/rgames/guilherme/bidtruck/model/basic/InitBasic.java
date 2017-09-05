package com.rgames.guilherme.bidtruck.model.basic;

import java.util.ArrayList;
import java.util.List;

public class InitBasic {

    private List<Delivery> mListDeliveries;
    private List<Romaneio> mListRomaneios;

    public InitBasic() {
        mListDeliveries = new ArrayList<>();
        mListRomaneios = new ArrayList<>();
    }

    public void addListDelivery(String titulo) {
        mListDeliveries.add(new Delivery(
                1, titulo
                , new Romaneio(0, new ArrayList<Delivery>(), 's', false)
                , new Addressee(0)
                , new StatusDelivery(0, new ArrayList<Delivery>(), new Occurrence(0, new ArrayList<StatusDelivery>(), new TypeOccurrence(0, "", 's'), "", 's'), null)
                , 0f, null, false));
    }

    public void addListRomaneios(String titulo) {
        addListDelivery(titulo);
        mListRomaneios.add(new Romaneio(5246, mListDeliveries, 's', false));
    }

    public List<Delivery> getListDelivery() {
        return mListDeliveries;
    }

    public List<Romaneio> getListRomaneios() {
        return mListRomaneios;
    }
}
