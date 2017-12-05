package com.rgames.guilherme.bidtruck.view.romaneios.entrega;


import android.annotation.SuppressLint;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.AnimationUtils;
import android.view.animation.LayoutAnimationController;
import android.widget.FrameLayout;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.controller.ControllerOcorrencia;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Destinatario;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.errors.EmpresaNullException;
import com.rgames.guilherme.bidtruck.model.repositors.EntregaRep;
import com.rgames.guilherme.bidtruck.model.repositors.RomaneioRep;

import java.util.List;


public class EntregaFragment extends Fragment {

    private Empresa mEmpresa;
    private List<Romaneio> mRomaneioList;
    private List<Entrega> mEntregaList;
    private Romaneio mRomaneio;
    private View view;
    private EntregaTask entregaTask;
    private RomaneioRep romaneioRep;
    private EntregaRep entregaRep;
    private Facade facade;
    private Context context;
    boolean tem_entrega = true;
    private ControllerOcorrencia controllerOcorrencia;

    public EntregaFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        try {
            view = inflater.inflate(R.layout.fragment_entrega, container, false);
            context = getActivity();
            Bundle mBundle = getArguments();

            romaneioRep = new RomaneioRep(context);
            entregaRep = new EntregaRep(context);
            facade = new Facade(context);
            mEmpresa = mBundle.getParcelable(Empresa.PARCEL_EMPRESA);
        } catch (Exception e) {
            e.printStackTrace();
        }

        return view;
    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            List<Entrega> listaEntregas = entregaRep.buscarEntrega();
            //List<Romaneio> listaRomaneios = romaneioRep.buscarRomaneio();

            if (facade.isConnected(context)) {
                buscarTipoOcorrencia();

                if (listaEntregas == null || listaEntregas.size() == 0) {
                    inicializaEntregas();
                    //tem_entrega = false;
                } else {
                    mRomaneioList = null;// se houver internet, a lista de entregas sera exibida novamente, caso o usuario saia do fragment e entre novamente
                    mRomaneioList = romaneioRep.buscarRomaneio();
                    //valida se a empresa selecionada é a mesma inserida no romaneio
                    if (mRomaneioList.size() == 0) {
                        initRecyclerView(null);
                        emptyViewVazio(true);
                        return;
                    } else {
                        if (mEmpresa.getCodigo() == mRomaneioList.get(0).getCodigo_empresa()) {
                            mRomaneio = mRomaneioList.get(0);
                            initRecyclerView(listaEntregas);
                        } else {
                            emptyView(true);
                            return;
                        }
                    }
                }
            } else {
                mEntregaList = null;
                mRomaneioList = null;
                mEntregaList = entregaRep.buscarEntrega();
                mRomaneioList = romaneioRep.buscarRomaneio();
                if (mRomaneioList.size() > 0 && mEntregaList.size() > 0) {
                    //initRecyclerView(null);
                    if (mEmpresa.getCodigo() == mRomaneioList.get(0).getCodigo_empresa()) {
                        mRomaneio = mRomaneioList.get(0);
                        initRecyclerView(mEntregaList);
                    }
                } else {
                    emptyView(true);
                    return;
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @SuppressLint("StaticFieldLeak")
    private void buscarTipoOcorrencia() {
        new AsyncTask<Void, Void, List<TipoOcorrencia>>() {
            @Override
            protected List<TipoOcorrencia> doInBackground(Void... voids) {
                controllerOcorrencia = new ControllerOcorrencia(getActivity());
                List<TipoOcorrencia> tipoOcorrencias = null;
                try {
                    tipoOcorrencias = controllerOcorrencia.selectTipo(mEmpresa.getCodigo());
                } catch (EmpresaNullException e) {
                    e.printStackTrace();
                }
                controllerOcorrencia.deleteTipoOcorrenciaTodos();
                return tipoOcorrencias;
            }

            @Override
            protected void onPostExecute(List<TipoOcorrencia> tipoOcorrencias) {
                if (tipoOcorrencias != null)
                    for (TipoOcorrencia tipoOcorrencia : tipoOcorrencias)
                        controllerOcorrencia.insertTipoOcorrencia(tipoOcorrencia);
            }
        }.execute();
    }

    public void inicializaEntregas() {
        if (entregaTask == null || entregaTask.getStatus() != AsyncTask.Status.RUNNING) {
            entregaTask = new EntregaTask();
            entregaTask.execute();
        } else {
            Toast.makeText(getActivity(), "Sem conexão, tente novamente mais tarde", Toast.LENGTH_SHORT).show();
            return;
        }

    }

    private void initRecyclerView(List<Entrega> entregas) throws Exception {
        RecyclerView r = view.findViewById(R.id.recyclerview);
        r.setLayoutManager(new LinearLayoutManager(context));
        mRomaneio.setEntregaList(entregas);
        r.setAdapter(new AdapterRecyclerDelivery(mRomaneio, context));
        //r.setAdapter(new AdapterRecyclerDelivery(mRomaneioList.get(0), context));
        LayoutAnimationController controller = AnimationUtils.loadLayoutAnimation(context, R.anim.list_layout);
        r.setLayoutAnimation(controller);
    }

    private class EntregaTask extends AsyncTask<Void, Void, Void> {

        private MyProgressBar myProgressBar;

        private void initProgressBar() throws ClassCastException, NullPointerException {
            if (myProgressBar == null) {
                myProgressBar = new MyProgressBar((FrameLayout) view.findViewById(R.id.frame_progress));
            }
        }

        private void finishProgressBar() throws Exception {
            if (myProgressBar != null) {
                myProgressBar.onFinish();
            }
        }

        private void setLocalEntregas(List<Entrega> entregas) {
            for (Entrega ent : entregas) {

                Entrega delivery = new Entrega();
                Destinatario destinatario = new Destinatario();
                StatusEntrega statusEntrega = new StatusEntrega();
                delivery.setNota_fiscal(ent.getNota_fiscal());
                delivery.setPeso(ent.getPeso());
                delivery.setSeq_entrega(ent.getSeq_entrega());

                destinatario.setId(ent.getDestinatario().getId());
                destinatario.setBairro(ent.getDestinatario().getBairro());
                destinatario.setCEP(ent.getDestinatario().getCEP());
                destinatario.setCidade(ent.getDestinatario().getCidade());
                destinatario.setCpf_cnpj(ent.getDestinatario().getCpf_cnpj());
                destinatario.setNumero(ent.getDestinatario().getNumero());
                destinatario.setEmail(ent.getDestinatario().getEmail());
                destinatario.setNome_fantasia(ent.getDestinatario().getNome_fantasia());
                destinatario.setRazao_social(ent.getDestinatario().getRazao_social());
                destinatario.setLogradouro(ent.getDestinatario().getLogradouro());
                destinatario.setUF(ent.getDestinatario().getUF());
                destinatario.setTelefone(ent.getDestinatario().getTelefone());
                destinatario.setLatitude(ent.getDestinatario().getLatitude());
                destinatario.setLongitude(ent.getDestinatario().getLongitude());
                destinatario.setComplemento(ent.getDestinatario().getComplemento());
                delivery.setDestinatario(destinatario);

                statusEntrega.setCodigo(ent.getStatusEntrega().getCodigo());
                statusEntrega.setDescricao(ent.getStatusEntrega().getDescricao());
                delivery.setStatusEntrega(statusEntrega);
                entregaRep.inserirEntrega(delivery, mRomaneio);
            }
        }

        @Override
        protected void onPreExecute() {
            try {
                initProgressBar();
            } catch (Exception e) {
                e.printStackTrace();
            }
        }

        @Override
        protected Void doInBackground(Void... voids) {
            try {
                mRomaneioList = facade.selectRomaneio(mEmpresa, facade.isLogged());
                if (mRomaneioList != null && mRomaneioList.size() > 0) {

                    for (int i = 0; i < mRomaneioList.size(); i++) {
                        if (mRomaneioList.get(i).getStatus_romaneio().getCodigo() == 3) {

                            if (romaneioRep.buscarRomaneio() == null || romaneioRep.buscarRomaneio().size() == 0) {
                                romaneioRep.inserir(mRomaneioList.get(i), mEmpresa);

                                mRomaneio = mRomaneioList.get(i);
                                mEntregaList = facade.selectEntrega(mRomaneio.getCodigo());
                                if (entregaRep.buscarEntrega() == null || entregaRep.buscarEntrega().size() == 0) {
                                    setLocalEntregas(mEntregaList);
                                }
                            }

                        }

                    }
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            try {
                finishProgressBar();
                if (mRomaneio != null) {
                    initRecyclerView(mEntregaList);

                    if (((AppCompatActivity) context).getSupportActionBar() != null) {
                        ((AppCompatActivity) context).getSupportActionBar().setTitle("Romaneio - N º " + mRomaneio.getCodigo());
                        ((AppCompatActivity) context).getSupportActionBar().setDisplayShowTitleEnabled(true);
                    } else
                        Toast.makeText(getActivity(), "Erro ao exibir numero do Romaneio", Toast.LENGTH_LONG).show();
                } else {
                    emptyView(true);
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
            super.onPostExecute(aVoid);
        }
    }

    private void emptyView(boolean isVisible) {
        view.findViewById(R.id.txt_empty).setVisibility((isVisible) ? View.VISIBLE : View.GONE);
        if (((AppCompatActivity) context).getSupportActionBar() != null) {
            ((AppCompatActivity) context).getSupportActionBar().setTitle("Romaneios");
            ((AppCompatActivity) context).getSupportActionBar().setDisplayShowTitleEnabled(true);
        }
    }

    private void emptyViewVazio(boolean isVisible) {
        view.findViewById(R.id.txt_empty1).setVisibility((isVisible) ? View.VISIBLE : View.GONE);
        if (((AppCompatActivity) context).getSupportActionBar() != null) {
            ((AppCompatActivity) context).getSupportActionBar().setTitle("Romaneios");
            ((AppCompatActivity) context).getSupportActionBar().setDisplayShowTitleEnabled(true);
        }
    }
}