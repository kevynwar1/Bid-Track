package com.rgames.guilherme.bidtruck.model.service;

import android.annotation.SuppressLint;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.os.IBinder;
import android.util.Log;

import com.rgames.guilherme.bidtruck.controller.ControllerOcorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;
import com.rgames.guilherme.bidtruck.model.dao.database.DAOOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpConnection;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;
import com.rgames.guilherme.bidtruck.model.repositors.EntregaRep;
import com.rgames.guilherme.bidtruck.model.repositors.RomaneioRep;

import java.util.ArrayList;
import java.util.List;

public class ServiceWifi extends Service {

    private boolean criado = false;
    private ThreadWifi threadWifi;
    private List<Romaneio> romaneioList;
    private List<Entrega> entregaList;
    private List<StatusEntrega> statusEntregaList;
    private List<Ocorrencia> ocorrenciaList;


    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    @Override
    public void onCreate() {
        super.onCreate();
    }

    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        if (!criado) {
            criado = true;
            threadWifi = new ThreadWifi();
            threadWifi.start();
        }
        return super.onStartCommand(intent, flags, startId);
    }

    private class ThreadWifi extends Thread {
        private boolean ativo = true;

        @Override
        public void run() {
            while (ativo) {
                try {
                    sleep(5000);
                    if (HttpConnection.isConnected(getApplicationContext())) {
                        Log.i("teste", "conectado");
                        metodoMuitoLokoQueFazSubirTodosOsDadosParaOServidor();
                        deleteLocal();// deleta quando o codigo do romaneio ser = 4
                    } else {
                        Log.i("teste", "nao conectado");
                    }
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
            stopSelf();
        }
    }

    @SuppressLint("StaticFieldLeak")
    private void metodoMuitoLokoQueFazSubirTodosOsDadosParaOServidor() {
        try {
            Context context = getApplicationContext();
            RomaneioRep romaneioRep = new RomaneioRep(context);
            romaneioList = romaneioRep.buscarRomaneio();
            if (romaneioList != null && romaneioList.size() > 0) {
                DAOOcorrencia daoOcorrencia = new DAOOcorrencia(context);
                ControllerOcorrencia controllerOcorrencia = new ControllerOcorrencia(context);
                EntregaRep entregaRep = new EntregaRep(context);
                entregaList = entregaRep.buscarEntrega();
                ocorrenciaList = new ArrayList<>();
                HttpEntrega httpEntrega = new HttpEntrega(context);
                HttpRomaneio httpRomaneio = new HttpRomaneio(context);
                for (Entrega entrega : entregaList) {
                    ocorrenciaList.addAll(daoOcorrencia.select(entrega.getSeq_entrega()
                            , romaneioList.get(0).getCodigo()));
                    httpEntrega.statusEntrega(entrega.getStatusEntrega().getCodigo()
                            , entrega.getSeq_entrega(), romaneioList.get(0).getCodigo());
//                    entregaRep.excluirEntrega(entrega, romaneioList.get(0));
                }

                if( romaneioList.size() > 0 && romaneioList.get(0).getStatus_romaneio().getCodigo() == 4) {//atualiza somente quando o codigo do romaneio for 4

                    httpRomaneio.statusRomaneioEntrega(romaneioList.get(0).getStatus_romaneio().getCodigo()
                            , romaneioList.get(0).getCodigo(), romaneioList.get(0).getMotorista().getCodigo());
                }

                Log.i("teste", "ocorrencias " + ocorrenciaList.size());
                for (Ocorrencia ocorrencia : ocorrenciaList) {
                    Log.i("teste", ocorrencia.getCodigo() + " is " + ocorrencia.inseridoApi);
                    if (!ocorrencia.inseridoApi) {
                        controllerOcorrencia.insert(ocorrencia, ocorrencia.getFotos());
                        ocorrencia.inseridoApi = true;
                        controllerOcorrencia.updateOcorrencia(ocorrencia);
                    }
                }


                //controllerOcorrencia.deleteOcorrenciaTodos();
                Log.i("teste", "ro" + romaneioList.size());
//                romaneioRep.excluirRomaneio(romaneioList.get(0));
                Log.i("teste", "Dizem que funcionou");
            } else Log.i("teste", "ja se foi");
//            new AsyncTask<Void, Void, Void>() {
//
//                @Override
//                protected Void doInBackground(Void... voids) {
//                    try {
//                        HttpURLConnection connection = HttpConnection.newInstance(URLDictionary.URL_SINCRONIZAR, HttpMethods.POST, false, true, "");
//                        JSONObject romaneiosJson;
//                        JSONArray generalArrayJSON = new JSONArray();
//                        for (Romaneio romaneio : romaneioList) {
//                            romaneiosJson = new JSONObject();
//                            romaneiosJson.accumulate("codigo", romaneio.getCodigo());
//                            romaneiosJson.accumulate("cod_empresa", romaneio.getCodigo_empresa());
//                            romaneiosJson.accumulate("cod_status_romaneio", romaneio.getStatus_romaneio().getCodigo());
//                            romaneiosJson.accumulate("cod_estabelecimento", romaneio.getEstabelecimento().getCodigo());
//                            romaneiosJson.accumulate("cod_motorista", romaneio.getMotorista().getCodigo());
//                            generalArrayJSON.put(romaneiosJson);
//                        }
//
//                        JSONObject entregasJson;
//                        for (Entrega entrega : entregaList) {
//                            entregasJson = new JSONObject();
//                            entregasJson.accumulate("seq_entrega", entrega.getSeq_entrega());
//                            entregasJson.accumulate("nota_fiscal", entrega.getNota_fiscal());
//                            entregasJson.accumulate("peso_carga", entrega.getPeso());
//                            entregasJson.accumulate("cnpj", entrega.getDestinatario().getCpf_cnpj());
//                            entregasJson.accumulate("email", entrega.getDestinatario().getEmail());
//                            entregasJson.accumulate("telefone", entrega.getDestinatario().getTelefone());
//                            entregasJson.accumulate("cep", entrega.getDestinatario().getCEP());
//                            entregasJson.accumulate("uf", entrega.getDestinatario().getUF());
//                            entregasJson.accumulate("cidade", entrega.getDestinatario().getCidade());
//                            entregasJson.accumulate("bairro", entrega.getDestinatario().getBairro());
//                            entregasJson.accumulate("logradouro", entrega.getDestinatario().getLogradouro());
//                            entregasJson.accumulate("numero", entrega.getDestinatario().getNumero());
//                            entregasJson.accumulate("complemento", entrega.getDestinatario().getComplemento());
//                            entregasJson.accumulate("cod_destinatario", entrega.getDestinatario().getId());
//                            entregasJson.accumulate("latitude", entrega.getDestinatario().getLatitude());
//                            entregasJson.accumulate("longitude", entrega.getDestinatario().getLongitude());
//                            entregasJson.accumulate("nome_fantasia_destinatario", entrega.getDestinatario().getNome_fantasia());
//                            entregasJson.accumulate("razao_social_destinatario", entrega.getDestinatario().getRazao_social());
//                            entregasJson.accumulate("cod_status_entrega", entrega.getStatusEntrega().getCodigo());
//                            entregasJson.accumulate("descricao_status", entrega.getStatusEntrega().getDescricao());
//                            generalArrayJSON.put(entregasJson);
//                        }
//                        JSONObject ocorrenciasJson;
//                        JSONObject fotoJsonObject;
//                        List<String> fotos;
//                        for (Ocorrencia ocorrencia : ocorrenciaList) {
//                            ocorrenciasJson = new JSONObject();
//                            fotoJsonObject = new JSONObject();
//                            ocorrenciasJson.accumulate("codigo", ocorrencia.getCodigo());
//                            ocorrenciasJson.accumulate("seq_entrega", ocorrencia.getEntrega().getSeq_entrega());
//                            ocorrenciasJson.accumulate("cod_tipo_ocorrencia", ocorrencia.getTipoOcorrencia().getCodigo());
//                            ocorrenciasJson.accumulate("cod_romaneio", ocorrencia.getRomaneio().getCodigo());
//                            ocorrenciasJson.accumulate("descricao", ocorrencia.getDescricao());
//                            fotos = new ArrayList<String>();
//                            for (Image foto : ocorrencia.getFotos()) {
//                                fotos.add(foto.getImagePath());
//                            }
//                            fotoJsonObject.accumulate("foto", fotos);
//                            generalArrayJSON.put(fotoJsonObject);
//                        }
//                        Log.i("teste", generalArrayJSON.toString());
//                        connection.getOutputStream().write(generalArrayJSON.toString().getBytes());
//                        connection.getOutputStream().flush();
//                        connection.getOutputStream().close();
//                        connection.disconnect();
//                    } catch (Exception e) {
//                        e.printStackTrace();
//                    }
//                    return null;
//                }
//            }.execute();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void deleteLocal(){
        Context context = getApplicationContext();
        EntregaRep  entregaRep = new EntregaRep(context);
        RomaneioRep romaneioRep = new RomaneioRep(context);

        List<Entrega> listaEntregas = entregaRep.buscarEntrega();
        List<Romaneio> listaRomaneios = romaneioRep.buscarRomaneio();

        if ((listaEntregas != null && listaEntregas.size() > 0) && (listaRomaneios.size() > 0 && listaRomaneios != null)) {
            if (listaRomaneios.get(0).getStatus_romaneio().getCodigo() == 4) {

                Entrega deleteEntrega = listaEntregas.get(listaEntregas.size() - 1);
                if (deleteEntrega.getStatusEntrega().getCodigo() == 4) {

                    for (Entrega ent : listaEntregas) {

                        entregaRep.excluirEntrega(ent, listaRomaneios.get(0));
                    }

                    romaneioRep.excluirRomaneio(listaRomaneios.get(0));

                }

            }

        }

    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        threadWifi.ativo = false;
    }
}
