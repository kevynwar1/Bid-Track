package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.ocorrencia.OcorrenciaActivity;

public class DetalhesPagerFragment extends Fragment {

    private Romaneio mRomaneio;
    private Entrega mEntrega;
    private View mView;

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
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void initViews() throws Exception {
        if (mView != null && mEntrega != null) {
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
            } else throw new NullPointerException("Destinatario nulo");

            initButtons();
        } else throw new NullPointerException("View/Entrega null");
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
                                Toast.makeText(getActivity(), "Finalizado", Toast.LENGTH_SHORT).show();
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

        mView.findViewById(R.id.btn_occurrence).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
//                AlertDialog.Builder builderSingle = new AlertDialog.Builder(getActivity());
//                builderSingle.setTitle("Selecione uma ocorrência.");
//
//                final ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(getActivity(), android.R.layout.select_dialog_singlechoice);
//                arrayAdapter.add("Almoço");
//                arrayAdapter.add("Caminhão quebrado");
//                arrayAdapter.add("10kg de maconha");
//                arrayAdapter.add("Iput4 stop");
//
//                builderSingle.setNegativeButton(getString(R.string.app_dlg_cancel), new DialogInterface.OnClickListener() {
//                    @Override
//                    public void onClick(DialogInterface dialog, int which) {
//                        dialog.dismiss();
//                    }
//                });
//
//                builderSingle.setAdapter(arrayAdapter, new DialogInterface.OnClickListener() {
//                    @Override
//                    public void onClick(DialogInterface dialog, int pos) {
//                        ((TextView) mView.findViewById(R.id.txtOcorrencia)).setText(arrayAdapter.getItem(pos));
//                        dialog.dismiss();
//                    }
//                });
//                builderSingle.show();

                Intent intent = new Intent(getActivity(), OcorrenciaActivity.class);
                Bundle bundle = new Bundle();
                bundle.putParcelable(Entrega.PARCEL, mEntrega);
                startActivity(intent.putExtras(bundle));
            }
        });
    }

    private AlertDialog newAlertDialog(String titulo, String msg) {
        AlertDialog alertDialog = new AlertDialog.Builder(getActivity()).create();
        alertDialog.setTitle(titulo);
        alertDialog.setMessage(msg);
        return alertDialog;
    }
}
