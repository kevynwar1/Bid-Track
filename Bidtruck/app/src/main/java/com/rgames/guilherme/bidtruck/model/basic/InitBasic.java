package com.rgames.guilherme.bidtruck.model.basic;

import java.util.ArrayList;
import java.util.List;

public class InitBasic {

    private List<Entrega> mListDeliveries;
    private List<Romaneio> mListRomaneios;
    private List<Ocorrencia> mListOcorrencia;

    public InitBasic() {
        mListDeliveries = new ArrayList<>();
        mListRomaneios = new ArrayList<>();
        mListOcorrencia = new ArrayList<>();
    }

    public void addListDelivery(String titulo) {
        Destinatario destinatario = new Destinatario(1, new ArrayList<Entrega>(), new Empresa("Empresa joselico")
                , "Frete Joselico LRRTDSA", "Frete Joselico", 't', "000000000", "email@email", "1111-2222", "Joselito", "54896-585", "BA"
                , "Augusta de Amorin", "Maranguape", "Rua Atras da Escola 101", "1001", "001Ml", 1, 2, false);
        mListDeliveries.add(new Entrega(
                1, titulo
//                , null
                , destinatario
                , new StatusEntrega(0, new ArrayList<Entrega>(), new Ocorrencia(0, new ArrayList<StatusEntrega>(), new TipoOcorrencia(0, "", 's'), "", 's'), null)
                , 0f, null, false));
    }

    public void addListRomaneios(String titulo) {
        try {
            addListDelivery(titulo);
            mListRomaneios.add(new Romaneio(5246, null, null, mListDeliveries, false, 's', false));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<Entrega> getListDelivery() {
        return mListDeliveries;
    }

    public List<Romaneio> getListRomaneios() {
        return mListRomaneios;
    }

    public List<Ocorrencia> getListOccurrence() {
        mListOcorrencia.add(new Ocorrencia(0, new ArrayList<StatusEntrega>(), new TipoOcorrencia(0, "10kg Maconha", 's'), "", 'a'));
        mListOcorrencia.add(new Ocorrencia(1, new ArrayList<StatusEntrega>(), new TipoOcorrencia(0, "Caminhão quebrado", 's'), "", 'a'));
        mListOcorrencia.add(new Ocorrencia(2, new ArrayList<StatusEntrega>(), new TipoOcorrencia(0, "Pneu furado", 's'), "", 'a'));
        mListOcorrencia.add(new Ocorrencia(3, new ArrayList<StatusEntrega>(), new TipoOcorrencia(0, "Lei seca", 's'), "", 'a'));
        return mListOcorrencia;
    }
}
