package com.rgames.guilherme.bidtruck.facade;


import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.util.List;

public interface IFacade {

    public String connectionTest();

    public List<Romaneio> selectRomaneio() throws Exception;

    public List<Entrega> selectEntrega() throws Exception;


}
