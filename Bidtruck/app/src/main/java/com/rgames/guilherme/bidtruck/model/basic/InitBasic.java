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
        Addressee addressee = new Addressee(1, new ArrayList<Delivery>(), new Enterprise("Empresa joselico")
                , "Frete Joselico LRRTDSA", "Frete Joselico", 't', "000000000", "email@email", "1111-2222", "Joselito", "54896-585", "BA"
                , "Augusta de Amorin", "Maranguape", "Rua Atras da Escola 101", "1001", "001Ml", 1, 2, false);
        mListDeliveries.add(new Delivery(
                1, titulo
//                , null
                , addressee
                , new StatusDelivery(0, new ArrayList<Delivery>(), new Occurrence(0, new ArrayList<StatusDelivery>(), new TypeOccurrence(0, "", 's'), "", 's'), null)
                , 0f, null, false));
    }

    public void addListRomaneios(String titulo) {
        try {
            addListDelivery(titulo);
            mListRomaneios.add(new Romaneio(5246, mListDeliveries, 's', false));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<Delivery> getListDelivery() {
        return mListDeliveries;
    }

    public List<Romaneio> getListRomaneios() {
        return mListRomaneios;
    }
}
