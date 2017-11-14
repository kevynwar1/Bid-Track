package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Destinatario;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.StatusEntrega;
import com.rgames.guilherme.bidtruck.model.basic.StatusRomaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpRomaneio;
import com.rgames.guilherme.bidtruck.model.repositors.EntregaRep;
import com.rgames.guilherme.bidtruck.model.repositors.RomaneioRep;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.EntregaActivity;

import java.util.ArrayList;
import java.util.List;

public class DetalhesPagerFragment extends Fragment {

    private MyProgressBar mProgressBar;
    private Romaneio mRomaneio;
    private Entrega mEntrega;
    private Destinatario mDestinatario;
    private View mView;
    private boolean tem_entrega;
    private boolean entrega_atualizada;
    private boolean entrega_ativa;
    private boolean sequencia_invalida;
    private boolean romaneio_inativo;
    private StatusTask mStatusTask;
    private ListaTask mListaTask;
    private List<Entrega> mEntregas;
    private StatusRomaneioTask mRomaneioTask;
    private List<Entrega> mListEntregas2;
    private RetornaTask mFinalTask;
    private boolean tem_entrega_nova;
    private boolean atualiza_status;



    public DetalhesPagerFragment() {
    }

    public static DetalhesPagerFragment newInstance(Romaneio romaneio, Entrega entrega) {
        DetalhesPagerFragment fragment = new DetalhesPagerFragment();
        Bundle bundle = new Bundle();
        bundle.putParcelable(Romaneio.PARCEL, romaneio);
        bundle.putParcelable(Entrega.PARCEL, entrega);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        mView = inflater.inflate(R.layout.fragment_destino_pagerk, container, false);
        if (getArguments() != null) {
            mRomaneio = getArguments().getParcelable(Romaneio.PARCEL);
            mEntrega = getArguments().getParcelable(Entrega.PARCEL);
           //RomaneioRep romaneioRep = new RomaneioRep(getActivity());
        } else mEntrega = new Entrega();



        return mView;

    }

    @Override
    public void onResume() {
        super.onResume();
        try {
            initViews();
            initButtons();


        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void initViews() throws Exception {
        if (mView != null)
            if (mEntrega != null) {
                //Entrega
//            ((TextView) mView.findViewById(R.id.txtCodEntrega)).setText(String.valueOf(mEntrega.getCodigo()));
                ((TextView) mView.findViewById(R.id.txtCodRomaneio)).setText(String.valueOf(mRomaneio.getCodigo()));
                ((TextView) mView.findViewById(R.id.txtNFS)).setText(mEntrega.getNota_fiscal());
                ((TextView) mView.findViewById(R.id.txtSequencia)).setText(String.valueOf(mEntrega.getSeq_entrega()));
                //((TextView) mView.findViewById(R.id.txtInicio)).setText(mRomaneio.getDate_create());
                //((TextView) mView.findViewById(R.id.txtTermino)).setText(mRomaneio.getDate_finalization());
                ((TextView) mView.findViewById(R.id.txtPeso)).setText(String.valueOf(mEntrega.getPeso()));
                //Destinatario
                if (mEntrega.getDestinatario() != null) {
                    //((TextView) mView.findViewById(R.id.txtDestEmpresa)).setText(mEntrega.getDestinatario().getEmpresa().getRazao_social());
                    ((TextView) mView.findViewById(R.id.txtDestRazao)).setText(mEntrega.getDestinatario().getRazao_social());
                    ((TextView) mView.findViewById(R.id.txtDestFantasia)).setText(mEntrega.getDestinatario().getNome_fantasia());
                    ((TextView) mView.findViewById(R.id.txtCNPJ)).setText(mEntrega.getDestinatario().getCpf_cnpj());
                    ((TextView) mView.findViewById(R.id.txtEmail)).setText(mEntrega.getDestinatario().getEmail());
                    ((TextView) mView.findViewById(R.id.txtDestTelefone)).setText(mEntrega.getDestinatario().getTelefone());
                    ((TextView) mView.findViewById(R.id.txtDestCEP)).setText(mEntrega.getDestinatario().getCEP());
                    ((TextView) mView.findViewById(R.id.txtDestUF)).setText(mEntrega.getDestinatario().getUF());
                    ((TextView) mView.findViewById(R.id.txtDestCidade)).setText(mEntrega.getDestinatario().getCidade());
                    ((TextView) mView.findViewById(R.id.txtDestBairro)).setText(mEntrega.getDestinatario().getBairro());
                    ((TextView) mView.findViewById(R.id.txtDestLogradouro)).setText(mEntrega.getDestinatario().getLogradouro());
                    ((TextView) mView.findViewById(R.id.txtDestNumero)).setText(mEntrega.getDestinatario().getNumero());
                    ((TextView) mView.findViewById(R.id.txtDestComplemento)).setText(mEntrega.getDestinatario().getComplemento());
                } else
                    Toast.makeText(getActivity(), getString(R.string.app_err_null_destinatario), Toast.LENGTH_SHORT).show();
                // initButtons();
            } else
                Toast.makeText(getActivity(), getString(R.string.app_err_null_entrega), Toast.LENGTH_SHORT).show();


    }


    public void iniciarAtualizacao() {
        if (mStatusTask == null || mStatusTask.getStatus() != AsyncTask.Status.RUNNING) {
            mStatusTask = new StatusTask();
            mStatusTask.execute();

        } else {
            Toast.makeText(getActivity(), "Sem conexão, tente novamente mais tarde", Toast.LENGTH_SHORT).show();
            return;
        }

    }

    public void atualizaRomaneio() {
        if (mRomaneioTask == null || mRomaneioTask.getStatus() != AsyncTask.Status.RUNNING) {
            mRomaneioTask = new StatusRomaneioTask();
            mRomaneioTask.execute();
        } else {
            Toast.makeText(getActivity(), "Sem conexão, tente novamente mais tarde", Toast.LENGTH_SHORT).show();
            return;
        }

    }


    public void alteraStatus() {
        if (mListaTask == null || mListaTask.getStatus() != AsyncTask.Status.RUNNING) {
            mListaTask = new ListaTask();
            mListaTask.execute();

        } else {
            Toast.makeText(getActivity(), "Sem conexão, tente novamente mais tarde", Toast.LENGTH_SHORT).show();
            return;
        }


    }


    public void listaFinal() {
        if (mFinalTask == null || mFinalTask.getStatus() != AsyncTask.Status.RUNNING) {
            mFinalTask = new RetornaTask();
            mFinalTask.execute();
        } else {
            Toast.makeText(getActivity(), "Sem conexão, tente novamente mais tarde", Toast.LENGTH_SHORT).show();
            return;
        }

    }


    class RetornaTask extends AsyncTask<Void, Void, List<Entrega>> {

        protected void onPreExecute() {
            try {
                super.onPreExecute();
                //emptyView(true);
                initProgressBar();

            } catch (Exception e) {
                e.printStackTrace();
            }
        }


        @Override
        protected List<Entrega> doInBackground(Void... String) {
            HttpEntrega httpEntrega = new HttpEntrega(getActivity());
            try {
                mListEntregas2 = httpEntrega.select();
            } catch (Exception e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(List<Entrega> entregas) {
            try {
                /*if (entregas == null || entregas.size() == 0)

                    mListEntregas2 = entregas;*/
                finishProgressBar();

            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }


    class StatusTask extends AsyncTask<Void, Void, Void> {


        protected void onPreExecute() {
            try {
                super.onPreExecute();
                //emptyView(true);
                initProgressBar();

            } catch (Exception e) {
                e.printStackTrace();
            }
        }


        //finaliza entrega e seta a entrega como finalizada
        @Override
        protected Void doInBackground(Void... voids) {

            HttpEntrega mHttpEntrega = new HttpEntrega(getActivity());
            if (mEntrega != null) {
                if (mEntrega.getStatusEntrega().getCodigo() == 3 && mEntrega.getSeq_entrega() > 0 && mRomaneio.getCodigo() > 0) {

                    int novo_status = 4;
                    int seq_entrega = mEntrega.getSeq_entrega();
                    int cod_romaneio = mRomaneio.getCodigo();
                    tem_entrega = mHttpEntrega.statusEntrega(novo_status, seq_entrega, cod_romaneio);

                    //as atualizacoes devem ser feitas em ambas plataformas, web e mobile.
                    tem_entrega_nova = false;
                    EntregaRep entregaRep = new EntregaRep(getActivity());
                    if(entregaRep.buscarEntrega() != null || entregaRep.buscarEntrega().size() > 0){

                        int novo_statuss = 4;
                        Entrega newEntrega = new Entrega();
                        Destinatario newDestinatario = new Destinatario();
                        StatusEntrega newstatusEntrega = new StatusEntrega();

                        newEntrega.setNota_fiscal(mEntrega.getNota_fiscal());
                        newEntrega.setPeso(mEntrega.getPeso());
                        newEntrega.setSeq_entrega(mEntrega.getSeq_entrega());

                       // newDestinatario.setId(mEntrega.getDestinatario().getId());
                       // newDestinatario.setBairro(mEntrega.getDestinatario().getBairro());
                       // newDestinatario.setCEP(mEntrega.getDestinatario().getCEP());
                        //newDestinatario.setEmail(mEntrega.getDestinatario().getEmail());
                       // newDestinatario.setCpf_cnpj(mEntrega.getDestinatario().getCpf_cnpj());
                       // newDestinatario.setCidade(mEntrega.getDestinatario().getCidade());
                       // newDestinatario.setNome_fantasia(mEntrega.getDestinatario().getNome_fantasia());
                        //newDestinatario.setRazao_social(mEntrega.getDestinatario().getRazao_social());
                        //newDestinatario.setLogradouro(mEntrega.getDestinatario().getLogradouro());
                       // newDestinatario.setUF(mEntrega.getDestinatario().getUF());
                       //newDestinatario.setTelefone(mEntrega.getDestinatario().getTelefone());
                        //newDestinatario.setLatitude(mEntrega.getDestinatario().getLatitude());
                        //newDestinatario.setLongitude(mEntrega.getDestinatario().getLongitude());
                        //newEntrega.setDestinatario(newDestinatario);

                        newstatusEntrega.setCodigo(novo_statuss);
                        newstatusEntrega.setDescricao("Finalizado");
                        newEntrega.setStatusEntrega(newstatusEntrega);

                        entregaRep.atualizaEntrega(newEntrega, mRomaneio);
                        tem_entrega_nova = true;


                    }




                }

            }

            return null;
        }


        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            try {

                //emptyView(false);
                finishProgressBar();
                if (mEntrega != null) {
                    if (tem_entrega || tem_entrega_nova) {
                        Toast.makeText(getActivity(), "Entrega finalizada com Sucesso!", Toast.LENGTH_SHORT).show();
                    }
                    else {
                        Toast.makeText(getActivity(), "Desculpe, erro ao finalizar a entrega, tente novamente!", Toast.LENGTH_LONG).show();
                    }
                }

            } catch (Exception e) {
                e.printStackTrace();
            }

        }

    }

    //lista as entregas novamente com o status atualizado
    class ListaTask extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            try {
                super.onPreExecute();
                // emptyView(true);
                initProgressBar();

            } catch (Exception e) {
                e.printStackTrace();
            }
        }

        // altera o status da proxima entrega de liberado para em Viagem
        @Override
        protected Void doInBackground(Void... String) {
            entrega_ativa = false;
            sequencia_invalida = false;
            HttpEntrega httpEntregas = new HttpEntrega(getActivity());
            try {

                mEntregas = httpEntregas.select();


                if (mEntregas != null) {
                    for (int j = 0; j < mEntregas.size(); j++) {

                        Entrega recebeStatusEntrega = mEntregas.get(j);
                        if (recebeStatusEntrega.getStatusEntrega().getCodigo() == 1 && recebeStatusEntrega.getSeq_entrega() > 0) {
                            HttpEntrega mHttpEntrega = new HttpEntrega(getActivity());
                            if (recebeStatusEntrega != null) {
                                int novo_status = 3;
                                int seq_nova_entrega = recebeStatusEntrega.getSeq_entrega();
                                int cod_romaneio = mRomaneio.getCodigo();
                                entrega_atualizada = mHttpEntrega.statusEntregaUltima(novo_status, seq_nova_entrega, cod_romaneio);
                                //entrega_atualizada = false;
                                break;

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
            super.onPostExecute(aVoid);
            try {
                //emptyView(false);
                EntregaRep entregaRep = new EntregaRep(getActivity());
                List<Entrega> novaEnterega = entregaRep.buscarEntrega();

                if(novaEnterega != null || novaEnterega.size() > 0){
                    atualiza_status = false;

                    for(int i = 0; i < novaEnterega.size(); i++){

                        Entrega novoStatusEntrega = novaEnterega.get(i);
                        if(novoStatusEntrega.getStatusEntrega().getCodigo() == 1 && novoStatusEntrega.getSeq_entrega() > 0){
                            if(novoStatusEntrega != null){

                                int novo_status_entrega = 3;

                                Entrega newEntrega = new Entrega();
                                Destinatario newDestinatario = new Destinatario();
                                StatusEntrega newstatusEntrega = new StatusEntrega();

                                newEntrega.setNota_fiscal(novoStatusEntrega.getNota_fiscal());
                                newEntrega.setPeso(novoStatusEntrega.getPeso());
                                newEntrega.setSeq_entrega(novoStatusEntrega.getSeq_entrega());

                                newstatusEntrega.setCodigo(novo_status_entrega);
                                newstatusEntrega.setDescricao("Em Viagem");
                                newEntrega.setStatusEntrega(newstatusEntrega);
                                entregaRep.atualizaEntrega(newEntrega, mRomaneio);
                                atualiza_status = true;


                                finishProgressBar();
                                if(atualiza_status || entrega_atualizada){

                                    Toast.makeText(getActivity(), "Sua próxima entrega foi iniciada, tenha uma boa viagem!", Toast.LENGTH_LONG).show();
                                }
                                else {
                                    Toast.makeText(getActivity(), "Desculpe, sua entrega não pode iniciada, tente novamente!", Toast.LENGTH_LONG).show();
                                }
                                break;



                            }



                    }



                    }


                }


            } catch (Exception e) {
                e.printStackTrace();
            }
        }

    }


    class StatusRomaneioTask extends AsyncTask<Void, Void, Void> {
        boolean romaneio_finalizado = false;

        @Override
        protected void onPreExecute() {
            try {
                super.onPreExecute();
                // emptyView(true);
                initProgressBar();

            } catch (Exception e) {
                e.printStackTrace();
            }
        }

        @Override
        protected Void doInBackground(Void... voids) {
            romaneio_inativo = false;
            try {


                if (mListEntregas2 != null) {
                    HttpRomaneio mhttpRomaneio = new HttpRomaneio(getActivity());
                    Entrega mEtrenga = mListEntregas2.get(mListEntregas2.size() - 1);
                    if (mEtrenga.getStatusEntrega().getCodigo() == 4 && mRomaneio.getCodigo() > 0) {

                        int novo_status = 4;
                        int cod_romaneio = mRomaneio.getCodigo();
                        int cod_motorista = mRomaneio.getMotorista().getCodigo();
                        romaneio_inativo = mhttpRomaneio.statusRomaneioEntrega(novo_status, cod_romaneio, cod_motorista);

                    }
                }
            } catch (Exception e) {
                e.printStackTrace();
            }

            return null;
        }


        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            try {
                    //finaliza o romaneio atual
                   EntregaRep entregaRep = new EntregaRep(getActivity());
                   RomaneioRep romaneioRep = new RomaneioRep(getActivity());
                   List<Entrega> entregasRomaneio = entregaRep.buscarEntrega();

                   if(entregasRomaneio !=  null){

                       Entrega entregaFinal = entregasRomaneio.get(entregasRomaneio.size() -1);
                       if(entregaFinal.getStatusEntrega().getCodigo() == 4 && mRomaneio.getCodigo() > 0) {


                           Romaneio romaneioFinal = new Romaneio();
                           StatusRomaneio statusRomaneio = new StatusRomaneio();

                           int novo_status_romaneio = 4;

                           statusRomaneio.setCodigo(novo_status_romaneio);
                           statusRomaneio.setDescricao("Finalizado");
                           romaneioFinal.setCodigo(mRomaneio.getCodigo());
                           romaneioFinal.setStatus_romaneio(statusRomaneio);
                           romaneioRep.atualizaEntrega(romaneioFinal);
                           romaneio_finalizado = true;


                           finishProgressBar();
                           if (romaneio_inativo || romaneio_finalizado) {
                               Toast.makeText(getActivity(), "Romaneio finalizado com Sucesso!", Toast.LENGTH_LONG).show();
                           } else{

                               Toast.makeText(getActivity(), "Desculpe, erro ao finalizar o romaneio atual, tente novamente!", Toast.LENGTH_LONG).show();
                           }
                       }

                   }

            } catch (Exception e) {
                e.printStackTrace();
            }

        }
    }


    private void initButtons() {
        //FINALIZAR
        mView.findViewById(R.id.btn_finalize).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                AlertDialog alertDialog = newAlertDialog(getString(R.string.app_name), "Deseja confirmar a entrega?");
                alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE
                        , getString(R.string.app_dlg_cancel)
                        , new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                dialogInterface.dismiss();
                            }
                        });

                if (mEntrega != null && mEntrega.getStatusEntrega().getCodigo()  == 1) {

                    Toast.makeText(getActivity(), "Esta entrega não pode ser finalizada, pois não esta em andamento", Toast.LENGTH_LONG).show();
                    return;

                } else if(mEntrega.getStatusEntrega().getCodigo() == 4) {
                    Toast.makeText(getActivity(), "Esta entrenga não pode ser inciada, pois ja foi finalizada!", Toast.LENGTH_LONG).show();
                    return;

                } else

                    alertDialog.setButton(AlertDialog.BUTTON_POSITIVE
                            , getString(R.string.app_dlg_confirm)
                            , new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {

                                    if (mEntrega != null) {
                                        iniciarAtualizacao();
                                        alteraStatus();
                                        listaFinal();
                                       atualizaRomaneio();
                                    }

                                    dialogInterface.dismiss();
                                }


                            });
                alertDialog.show();


            }
        });

       /* mView.findViewById(R.id.btn_iniciar).setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {
                AlertDialog alertDialog = newAlertDialog("Bid & Track", "Deseja inciar uma nova entrega?");
                alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE
                        , "Cancelar"
                        , new DialogInterface.OnClickListener() {

                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                dialogInterface.dismiss();
                            }
                        });

                if (mEntrega != null && mEntrega.getStatusEntrega().getCodigo() == 3) {

                    Toast.makeText(getActivity(), "Esta entrega não pode ser iniciada, pois ela ja esta em viagem!", Toast.LENGTH_LONG).show();
                    return;
                } else if (mEntrega.getStatusEntrega().getCodigo() == 4) {

                    Toast.makeText(getActivity(), "Esta entrenga não pode ser inciada, pois ja foi finalizada!", Toast.LENGTH_LONG).show();
                    return;

                    //refazer validação aqui!
                } else
                    alertDialog.setButton(AlertDialog.BUTTON_POSITIVE
                            , "Confirmar"
                            , new DialogInterface.OnClickListener() {

                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {
                                    if (mEntrega != null) {
                                        alteraStatus();
                                    }

                                    dialogInterface.dismiss();
                                }

                            });
                alertDialog.show();

            }

        });*/

    }


    //CANCELAR
        /*mView.findViewById(R.id.btn_cancel).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog alertDialog = newAlertDialog(getString(R.string.app_name), "Deseja cancelar o romaneio?");
                alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE
                        , getString(R.string.app_dlg_cancel)
                        , new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                dialogInterface.dismiss();
                            }
                        });
                alertDialog.setButton(AlertDialog.BUTTON_POSITIVE
                        , getString(R.string.app_dlg_confirm)
                        , new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                Toast.makeText(getActivity(), "Cancelado", Toast.LENGTH_SHORT).show();
                                dialogInterface.dismiss();
                            }
                        });
                alertDialog.show();
            }
        });*/

    //OCORRENCIA

//        mView.findViewById(R.id.btn_occurrence).setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
////                AlertDialog.Builder builderSingle = new AlertDialog.Builder(getActivity());
////                builderSingle.setTitle("Selecione uma ocorrência.");
////
////                final ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(getActivity(), android.R.layout.select_dialog_singlechoice);
////                arrayAdapter.add("Almoço");
////                arrayAdapter.add("Caminhão quebrado");
////                arrayAdapter.add("10kg de maconha");
////                arrayAdapter.add("Iput4 stop");
////
////                builderSingle.setNegativeButton(getString(R.string.app_dlg_cancel), new DialogInterface.OnClickListener() {
////                    @Override
////                    public void onClick(DialogInterface dialog, int which) {
////                        dialog.dismiss();
////                    }
////                });
////
////                builderSingle.setAdapter(arrayAdapter, new DialogInterface.OnClickListener() {
////                    @Override
////                    public void onClick(DialogInterface dialog, int pos) {
////                        ((TextView) mView.findViewById(R.id.txtOcorrencia)).setText(arrayAdapter.getItem(pos));
////                        dialog.dismiss();
////                    }
////                });
////                builderSingle.show();
//
//                Intent intent = new Intent(getActivity(), OcorrenciaActivity.class);
//                Bundle bundle = new Bundle();
//                bundle.putParcelable(Entrega.PARCEL, mEntrega);
//                startActivity(intent.putExtras(bundle));
//            }
//        });






   /* private void exibirProgress(boolean exibir){
        if(exibir){

           // mTexto.setText("Carregando próxima viagem...");
        }

       // mProgressBar.setVisibility(exibir ? View.VISIBLE : View.GONE);

    }*/


    private void emptyView(boolean isVisible) {
        mView.findViewById(R.id.empty).setVisibility((isVisible) ? View.VISIBLE : View.GONE);
    }


    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (mProgressBar == null)
            mProgressBar = new MyProgressBar((FrameLayout) mView.findViewById(R.id.frame_progress));
        // mTexto.setText("Carregando próxima viagem...");
        // mTexto.setVisibility(View.VISIBLE);
    }

    private void finishProgressBar() throws Exception {
        if (mProgressBar != null) {
            mProgressBar.onFinish();
        }
    }


    private AlertDialog newAlertDialog(String titulo, String msg) {
        AlertDialog alertDialog = new AlertDialog.Builder(getActivity()).create();
        alertDialog.setTitle(titulo);
        alertDialog.setMessage(msg);
        return alertDialog;
    }


}
