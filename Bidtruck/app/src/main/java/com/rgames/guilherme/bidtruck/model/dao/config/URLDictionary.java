package com.rgames.guilherme.bidtruck.model.dao.config;

public enum URLDictionary {

    URL_MAIN("http://coopera.pe.hu/ws"),
    URL_ROMANEIO("/romaneio"),
    URL_COMPANY("/empresa"),
    URL_DRIVER("/motorista"),
    URL_DELIVERY("/entrega");

    private String value;

    URLDictionary(String value) {
        this.value = value;
    }

    public String getValue() {
        //nao chame o URL_MAIN vai estourar a memoria.
        return (value.equals("http://coopera.pe.hu/ws"))
                ? value
                : new StringBuilder("http://coopera.pe.hu/ws").append(value).toString();
    }
}
