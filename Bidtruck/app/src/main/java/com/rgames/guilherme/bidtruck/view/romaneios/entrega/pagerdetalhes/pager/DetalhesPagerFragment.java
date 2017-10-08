package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.controller.ControllerEntregas;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpEntrega;
import com.rgames.guilherme.bidtruck.model.errors.ContextNullException;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.AdapterRecyclerDelivery;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.ocorrencia.OcorrenciaActivity;

import java.util.ArrayList;
import java.util.List;

public class DetalhesPagerFragment extends Fragment{

    private Romaneio mRomaneio;
    private Entrega mEntrega;
    private View mView;
    private boolean tem_entrega;
    private boolean entrega_atualizada;
    private StatusTask mStatus;
    private AtualizaTask mAtualiza;
    private ListaTask mLista;
    private List<Entrega> mEntregas;






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
        if (getArguments() != null) {
            mRomaneio = getArguments().getParcelable(Romaneio.PARCEL);
            mEntrega = getArguments().getParcelable(Entrega.PARCEL);
            mStatus = new StatusTask();
            mAtualiza = new AtualizaTask();
            mLista = new ListaTask();
        } else mEntrega = new Entrega();
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return mView = inflater.inflate(R.layout.fragment_destino_pagerk, container, false);

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
                ((TextView) mView.findViewById(R.id.txtInicio)).setText(mRomaneio.getDate_create());
                ((TextView) mView.findViewById(R.id.txtTermino)).setText(mRomaneio.getDate_finalization());
                ((TextView) mView.findViewById(R.id.txtPeso)).setText(String.valueOf(mEntrega.getPeso()));
                //Destinatario
                if (mEntrega.getDestinatario() != null) {
                    ((TextView) mView.findViewById(R.id.txtDestEmpresa)).setText(mEntrega.getDestinatario().getEmpresa().getRazao_social());
                    ((TextView) mView.findViewById(R.id.txtDestRazao)).setText(mEntrega.getDestinatario().getRazao_social());
                    ((TextView) mView.findViewById(R.id.txtDestFantasia)).setText(mEntrega.getDestinatario().getNome_fantasia());
                    ((TextView) mView.findViewById(R.id.txtDestTelefone)).setText(mEntrega.getDestinatario().getTelefone());
                    ((TextView) mView.findViewById(R.id.txtDestCEP)).setText(mEntrega.getDestinatario().getCEP());
                    ((TextView) mView.findViewById(R.id.txtDestUF)).setText(mEntrega.getDestinatario().getUF());
                    ((TextView) mView.findViewById(R.id.txtDestCidade)).setText(mEntrega.getDestinatario().getCidade());
                    ((TextView) mView.findViewById(R.id.txtDestBairro)).setText(mEntrega.getDestinatario().getBairro());
                    ((TextView) mView.findViewById(R.id.txtDestLogradouro)).setText(mEntrega.getDestinatario().getLogradouro());
                    ((TextView) mView.findViewById(R.id.txtDestNumero)).setText(mEntrega.getDestinatario().getNumero());
                    ((TextView) mView.findViewById(R.id.txtDestComplemento)).setText(mEntrega.getDestinatario().getComplemento());
                }else Toast.makeText(getActivity(), getString(R.string.app_err_null_destinatario), Toast.LENGTH_SHORT).show();
               // initButtons();
            } else Toast.makeText(getActivity(), getString(R.string.app_err_null_entrega), Toast.LENGTH_SHORT).show();

    }



    class StatusTask extends AsyncTask<Void, Void, Void>{


        @Override
        protected Void doInBackground(Void... voids) {
            HttpEntrega mHttpEntrega = new HttpEntrega(getActivity());
            if(mEntrega != null){
                if(mEntrega.getStatusEntrega().getCodigo() == 3 && mEntrega.getSeq_entrega() > 0 && mRomaneio.getCodigo() > 0){

                    int novo_status = 4;
                    //int status_entrega = mEntrega.getStatusEntrega().setCodigo(novo_status);
                    int seq_entrega = mEntrega.getSeq_entrega();
                    int cod_romaneio = mRomaneio.getCodigo();
                    tem_entrega = mHttpEntrega.statusEntrega(novo_status,seq_entrega,cod_romaneio);
                }
                else{
                    Toast.makeText(getActivity(),"Desculpe, você tem permissão para finalizar esta entrega!",Toast.LENGTH_SHORT).show();
                }
            }

            return null;
        }


        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            if(tem_entrega) {
                Toast.makeText(getActivity(), "Entrega finalizada com Sucesso!", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(getActivity(), "Desculpe, erro ao finalizar a entrega, tente novamente!", Toast.LENGTH_LONG).show();
            }
        }
    }

    class ListaTask extends AsyncTask<Void, Void, List<Entrega>>{

        @Override
        protected List<Entrega> doInBackground(Void... String) {
            //Facade facade = new Facade(getActivity());
            HttpEntrega httpEntregas = new HttpEntrega(getActivity());
            try {
                return httpEntregas.select();


            } catch (Exception e) {
                e.printStackTrace();
            }
            return null;
        }


        @Override
        protected void onPostExecute(List<Entrega> entregas) {
            super.onPostExecute(entregas);
            try {
                if (entregas == null || entregas.size() > 0) {

                    mEntregas = entregas;

                }
            }catch (Exception e) {
                e.printStackTrace();
            }
        }

    }


    class AtualizaTask extends AsyncTask<Void, Void, Void>{

        @Override
        protected Void doInBackground(Void... voids) {
            //Facade facade = new Facade(getActivity());
            HttpEntrega httpEntregas = new HttpEntrega(getActivity());
            try {
                if(mEntregas != null){
                    for (int i = 0; i < mEntregas.size(); i++) {

                        Entrega atualizaEntrega = mEntregas.get(i);
                        if (atualizaEntrega.getStatusEntrega().getCodigo() == 4 && atualizaEntrega.getSeq_entrega() > 0) {

                            for (int j = 0; j < mEntregas.size(); j++) {

                                Entrega recebeStatusEntrega = mEntregas.get(j);
                                if (recebeStatusEntrega.getStatusEntrega().getDescricao().equals("Liberado") && recebeStatusEntrega.getSeq_entrega() > atualizaEntrega.getSeq_entrega()) {
                                    HttpEntrega mHttpEntrega = new HttpEntrega(getActivity());
                                    if (recebeStatusEntrega != null) {
                                        int novo_status = 3;
                                        int seq_nova_entrega = recebeStatusEntrega.getSeq_entrega();
                                        int cod_romaneio = mRomaneio.getCodigo();
                                        entrega_atualizada = mHttpEntrega.statusEntregaUltima(novo_status,seq_nova_entrega,cod_romaneio);

                                    }
                                    break;

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
        protected void onPostExecute(Void voids) {
            super.onPostExecute(voids);

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
                alertDialog.setButton(AlertDialog.BUTTON_POSITIVE
                        , getString(R.string.app_dlg_confirm)
                        , new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                mStatus.execute();
                               // Toast.makeText(getActivity(), "Finalizado", Toast.LENGTH_SHORT).show();
                                dialogInterface.dismiss();
                            }
                        });
                alertDialog.show();
            }
        });

        //CANCELAR
        mView.findViewById(R.id.btn_cancel).setOnClickListener(new View.OnClickListener() {
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
        });

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
    }

    private AlertDialog newAlertDialog(String titulo, String msg) {
        AlertDialog alertDialog = new AlertDialog.Builder(getActivity()).create();
        alertDialog.setTitle(titulo);
        alertDialog.setMessage(msg);
        return alertDialog;
    }
}
