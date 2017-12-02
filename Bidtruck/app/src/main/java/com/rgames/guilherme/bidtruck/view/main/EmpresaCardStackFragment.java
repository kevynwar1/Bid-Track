package com.rgames.guilherme.bidtruck.view.main;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.inputmethod.InputMethodManager;
import android.widget.AdapterView;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.errors.ContextNullException;
import com.rgames.guilherme.bidtruck.model.repositors.EmpresaRep;
import com.rgames.guilherme.bidtruck.view.empresa.EmpresaAdapter;
import com.rgames.guilherme.bidtruck.view.romaneios.entrega.EntregaActivity;

import java.util.ArrayList;
import java.util.List;

public class EmpresaCardStackFragment extends Fragment {

    // private static final String ARG_PARAM1 = "param1";
    //private static final String ARG_PARAM2 = "param2";

    private ListView empresaList;
    private Facade facade;
    private Empresa emp;

    private MyProgressBar myProgressBar;
    private Motorista motorista;
    private View mView;
    private boolean CRIADO = false;

    private EmpresaRep empresaRep;

    public EmpresaCardStackFragment() {
        // Required empty public constructor
    }


    public static EmpresaCardStackFragment newInstance() {
        return new EmpresaCardStackFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        empresaRep = new EmpresaRep(getActivity());
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return mView = inflater.inflate(R.layout.fragment_empresa_card_stack, container, false);
    }

    @Override
    public void onResume() {
       // Toast.makeText(getActivity(), "Estou no card empresa", Toast.LENGTH_LONG).show();
        facade = new Facade(getActivity());
        if (!CRIADO) {
            init();
        }

        super.onResume();
    }

    @Override
    public void setUserVisibleHint(boolean isVisibleToUser) {
        super.setUserVisibleHint(isVisibleToUser);
        if (isVisibleToUser && !CRIADO) {
            init();
        }
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);

    }

    /**
     * EM METODO SEPARDO POIS ESTOU VERIFICANDO O MELHOR LOCAL PARA ELE
     */
    private void init() {
        try {
            if (getActivity() != null) {
                final InputMethodManager imm = (InputMethodManager) getActivity().getSystemService(Context.INPUT_METHOD_SERVICE);
                if (imm != null)
                    if (getView() != null)
                        imm.hideSoftInputFromWindow(getView().getWindowToken(), 0);
                //   facade = new Facade(getActivity());
                motorista = facade.isLogged();
                viewSemMotorista(true);
                empresaList = (ListView) mView.findViewById(R.id.lv_empresas);
                if (motorista.getCodigo() > 0) {
                    empresaList.setDivider(null);
                    if (!facade.isConnected(getActivity())) {
                        Empresa company = empresaRep.buscarEmpresa();
                        if (company != null) {
                            Intent it = new Intent(getActivity(), MainActivity.class);
                            Bundle b = new Bundle();
                            b.putParcelable(Empresa.PARCEL_EMPRESA, company);
                            startActivity(it.putExtras(b));
                        }
                    } else {
                        initList();
                    }
                } else
                    viewSemMotorista(false);
            } else throw new ContextNullException();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void viewSemMotorista(boolean isOk) {
        mView.findViewById(R.id.txtSemMotorista).setVisibility((isOk) ? View.GONE : View.VISIBLE);
    }

    private void initList() {
        new AsyncTask<Void, Void, List<Empresa>>() {
            ProgressDialog dialog;

            @Override
            protected void onPreExecute() {
                try {
                    dialog = ProgressDialog.show(getActivity(), "Aguarde", "Verificando Empresas", true);
                    //     initProgressBar();

                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            protected List<Empresa> doInBackground(Void... String) {
                try {
                    return facade.selectEmpresa(motorista);
                } catch (Exception e) {
                    e.printStackTrace();
                }
                return null;
            }

            @Override
            protected void onPostExecute(List<Empresa> empresas) {
                try {
                    if (empresas != null) {
                        if (empresas.size() > 0 && empresas.size() == 1) {
                            Intent it = new Intent(getActivity(), MainActivity.class);
                            Bundle b = new Bundle();
                            emp = empresas.get(0);
                            empresaRep.insertEmpresa(empresas.get(0));
                            b.putParcelable(Empresa.PARCEL_EMPRESA, emp);
                            // b.putParcelable(Motorista.PARCEL_MOTORISTA, motorista);
                            startActivity(it.putExtras(b));
                            getActivity().finish();
                        } else if (empresas.size() == 0) {
                            Toast.makeText(getActivity(), "Você não está vinculado em nenhuma empresa ", Toast.LENGTH_LONG).show();
                            deslogar();
                        } else {
                            initView(empresas);
                        }
                    }// else {
                    // Toast.makeText(getActivity(), "Você não está vinculado em nenhuma empresa - ERR 2", Toast.LENGTH_LONG).show();
                    // deslogar();
                    //}
                } catch (Exception e) {
                    e.printStackTrace();
                    deslogar();
                } finally {
                    try {
                        CRIADO = true;
                        dialog.dismiss();
                        // finishProgressBar();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
            }
        }.execute();
    }

    private void deslogar() {
        facade.setLogged(new Motorista(0, "",""));
    }

    private void initView(List<Empresa> empresas) throws Exception {
        empresaList = (ListView) mView.findViewById(R.id.lv_empresas);
        EmpresaAdapter empresaAdapter = new EmpresaAdapter(getActivity(), empresas);
        empresaList.setAdapter(empresaAdapter);
        clickLista();
    }


    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (myProgressBar == null)
            myProgressBar = new MyProgressBar((FrameLayout) mView.findViewById(R.id.frame_progress));
    }

    private void finishProgressBar() throws Exception {
        if (myProgressBar != null) {
            myProgressBar.onFinish();
        }
    }

    private void clickLista() {
        empresaList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Empresa empresa = (Empresa) adapterView.getAdapter().getItem(i);
                boolean ok = empresaRep.insertEmpresa(empresa);
                Intent it = new Intent(getActivity(), MainActivity.class);
                Bundle b = new Bundle();
                b.putParcelable(Empresa.PARCEL_EMPRESA, empresa);
                startActivity(it.putExtras(b));
            }
        });
    }
}