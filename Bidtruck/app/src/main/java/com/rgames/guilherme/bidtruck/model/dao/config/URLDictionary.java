package com.rgames.guilherme.bidtruck.model.dao.config;

public enum URLDictionary {

    URL_MAIN("http://coopera.pe.hu/ws"),
    URL_ROMANEIO("/romaneio"),
    URL_COMPANY("/empresa"),
    URL_EMPRESA_MOTORISTA("/empresa_motorista"),
    URL_DRIVER("/motorista"),
    URL_DELIVERY("/entrega"),
    URL_OFFER("/romaneio_ofertavel/"),
    URL_LOGIN("/motorista_login"),
    URL_USER("/usuario"),
    URL_ESQUECI_SENHA("/motorista_esqueci_senha"),
    URL_ROMANEIO_EMPRESA("/romaneio_motorista_empresa"),
    URL_DELIVERY_DRIVER("/entrega_motorista/"),
    URL_ROMANEIO_DRIVER("/romaneio_motorista/"),
    URL_DELIVERY_FOR_DRIVER("/entrega_motorista/"),
    URL_ENTREGA_ROMANEIO("/entrega_romaneio/");

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
