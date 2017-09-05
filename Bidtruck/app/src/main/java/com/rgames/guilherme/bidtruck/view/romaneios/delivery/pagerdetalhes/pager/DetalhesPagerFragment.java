package com.rgames.guilherme.bidtruck.view.romaneios.delivery.pagerdetalhes.pager;

import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Delivery;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

public class DetalhesPagerFragment extends Fragment {

    private Romaneio mRomaneio;
    private Delivery mDelivery;
    private View mView;

    public DetalhesPagerFragment() {
    }

    public static DetalhesPagerFragment newInstance(Romaneio romaneio, Delivery delivery) {
        DetalhesPagerFragment fragment = new DetalhesPagerFragment();
        Bundle bundle = new Bundle();
        bundle.putParcelable(Romaneio.PARCEL, romaneio);
        bundle.putParcelable(Delivery.PARCEL, delivery);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mRomaneio = getArguments().getParcelable(Romaneio.PARCEL);
            mDelivery = getArguments().getParcelable(Delivery.PARCEL);
        } else mDelivery = new Delivery();
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
        if (mView != null && mDelivery != null) {
            //Delivery
            ((TextView) mView.findViewById(R.id.txtCodEntrega)).setText(String.valueOf(mDelivery.getId()));
            ((TextView) mView.findViewById(R.id.txtCodRomaneio)).setText(String.valueOf(mRomaneio.getId()));
            ((TextView) mView.findViewById(R.id.txtNFS)).setText("0000000-nfs");
            ((TextView) mView.findViewById(R.id.txtSequencia)).setText("2-seq");
            ((TextView) mView.findViewById(R.id.txtInicio)).setText("00/00/0000 00:00-inic");
            ((TextView) mView.findViewById(R.id.txtTermino)).setText("00/00/0000 00:00-fim");
            ((TextView) mView.findViewById(R.id.txtPeso)).setText("500kg-pes");
            //Addressee
            if (mDelivery.getAddressee() != null) {
                ((TextView) mView.findViewById(R.id.txtDestEmpresa)).setText(mDelivery.getAddressee().getEnterprise().getRazao_social());
                ((TextView) mView.findViewById(R.id.txtDestRazao)).setText(mDelivery.getAddressee().getRazao_social());
                ((TextView) mView.findViewById(R.id.txtDestFantasia)).setText(mDelivery.getAddressee().getNome_fantasia());
                ((TextView) mView.findViewById(R.id.txtDestTelefone)).setText(mDelivery.getAddressee().getTelefone());
                ((TextView) mView.findViewById(R.id.txtDestCEP)).setText(mDelivery.getAddressee().getCEP());
                ((TextView) mView.findViewById(R.id.txtDestUF)).setText(mDelivery.getAddressee().getUF());
                ((TextView) mView.findViewById(R.id.txtDestCidade)).setText(mDelivery.getAddressee().getCidade());
                ((TextView) mView.findViewById(R.id.txtDestBairro)).setText(mDelivery.getAddressee().getBairro());
                ((TextView) mView.findViewById(R.id.txtDestLogradouro)).setText(mDelivery.getAddressee().getLogradouro());
                ((TextView) mView.findViewById(R.id.txtDestNumero)).setText(mDelivery.getAddressee().getNumero());
                ((TextView) mView.findViewById(R.id.txtDestComplemento)).setText(mDelivery.getAddressee().getComplemento());
            } else throw new NullPointerException("Addressee nulo");

            initButtons();
        } else throw new NullPointerException("View/Delivery null");
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
                AlertDialog.Builder builderSingle = new AlertDialog.Builder(getActivity());
                builderSingle.setTitle("Selecione uma ocorrência.");

                final ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(getActivity(), android.R.layout.select_dialog_singlechoice);
                arrayAdapter.add("Almoço");
                arrayAdapter.add("Caminhão quebrado");
                arrayAdapter.add("10kg de maconha");
                arrayAdapter.add("Iput4 stop");

                builderSingle.setNegativeButton(getString(R.string.app_dlg_cancel), new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                    }
                });

                builderSingle.setAdapter(arrayAdapter, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int pos) {
                        ((TextView) mView.findViewById(R.id.txtOcorrencia)).setText(arrayAdapter.getItem(pos));
                        dialog.dismiss();
                    }
                });
                builderSingle.show();
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
