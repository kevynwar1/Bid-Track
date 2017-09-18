package com.rgames.guilherme.bidtruck.facade;

import android.content.Context;
import android.util.Log;

import com.rgames.guilherme.bidtruck.controller.ControllerEmpresa;
import com.rgames.guilherme.bidtruck.controller.ControllerEntregas;
import com.rgames.guilherme.bidtruck.controller.ControllerLogin;
import com.rgames.guilherme.bidtruck.controller.ControllerRomaneio;
import com.rgames.guilherme.bidtruck.controller.ControllerUsuario;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.Usuario;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;
import com.rgames.guilherme.bidtruck.model.errors.MotoristaNaoConectadoException;

import java.util.IllegalFormatException;
import java.util.List;

public class Facade implements IFacade {

    private Context mContext;
    private ControllerRomaneio controllerRomaneio;
    private ControllerEntregas controllerEntregas;
    private ControllerLogin controllerLogin;
    private ControllerUsuario controllerUsuario;
    private ControllerEmpresa controllerEmpresa;

    public Facade(Context context) {
        mContext = context;
    }

    @Override
    public String connectionTest() {
        if (HttpConnection.isConnected(mContext))
            return HttpConnection.ConnecetinTest();
        else return "Sem conexão, tente novamente! ";
    }

    @Override
    public boolean isConnected(Context context) {
        return HttpConnection.isConnected(context);
    }

    @Override
    public List<Romaneio> selectRomaneio(Motorista motorista) throws MotoristaNaoConectadoException {
        if (controllerRomaneio == null)
            controllerRomaneio = new ControllerRomaneio(mContext);
        return controllerRomaneio.select(motorista);
    }

    @Override
    public List<Romaneio> selectRomaneioOfertado(Motorista motorista) throws MotoristaNaoConectadoException, NullPointerException {
        if (controllerRomaneio == null) controllerRomaneio = new ControllerRomaneio(mContext);
        return controllerRomaneio.selectOffers(motorista);
    }


    public List<Entrega> selectEntrega() {
        if (controllerEntregas == null)
            controllerEntregas = new ControllerEntregas(mContext);
        return controllerEntregas.select();

    }

    @Override
    public List<Empresa> selectEmpresa(Motorista motorista) throws Exception {
        if (controllerEmpresa == null)
            controllerEmpresa = new ControllerEmpresa(mContext);
        return controllerEmpresa.selectEmpresas(motorista);
    }

    @Override
    public Motorista login(String email, String senha) throws IllegalFormatException, NullPointerException {
        if (controllerLogin == null) controllerLogin = new ControllerLogin(mContext);
        return controllerLogin.login(email, senha);
    }

    @Override
    public Usuario login(String email) throws IllegalArgumentException, NullPointerException {
        if (controllerUsuario == null) controllerUsuario = new ControllerUsuario(mContext);
        return controllerUsuario.login(email);
    }


    @Override
    public Motorista isLogged() {
        if (controllerLogin == null) controllerLogin = new ControllerLogin(mContext);
        return controllerLogin.isLogged();
    }

    @Override
    public void setLogged(Motorista motorista) throws NullPointerException {
        if (controllerLogin == null) controllerLogin = new ControllerLogin(mContext);
        controllerLogin.setLogged(motorista);
    }

    @Override
    public boolean isMatenhaConectado() {
        if (controllerLogin == null) controllerLogin = new ControllerLogin(mContext);
        return controllerLogin.isMatenhaConectado();
    }

    @Override
    public void setMatenhaConectado(boolean isConnected) {
        if (controllerLogin == null) controllerLogin = new ControllerLogin(mContext);
        controllerLogin.setMatenhaConectado(isConnected);
    }


}
