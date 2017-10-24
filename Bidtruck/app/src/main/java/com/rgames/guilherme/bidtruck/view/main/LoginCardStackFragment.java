package com.rgames.guilherme.bidtruck.view.main;


import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Typeface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Parcelable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;

import java.util.List;

public class LoginCardStackFragment extends Fragment {

    private EditText edtSenha, edtEmail;
    private TextView tvSenha;
    private TextView tvError;
    private TextView tvConectado;
    private Button btLogin;
    private MyProgressBar myProgressBar;
    private Facade mFacade;
    private View mView;
    private IGoToEmpresa listener;
    private boolean isLogged;

    public LoginCardStackFragment() {
        // Required empty public constructor
    }

    public static LoginCardStackFragment newInstance(boolean isLogin) {
        LoginCardStackFragment fragment = new LoginCardStackFragment();
        Bundle bundle = new Bundle();
        bundle.putBoolean("login", isLogin);
        fragment.setArguments(bundle);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null)
            isLogged = getArguments().getBoolean("login");
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return mView = inflater.inflate(R.layout.fragment_card_stack, container, false);
    }

    @Override
    public void onResume() {
        super.onResume();
        mFacade = new Facade(getActivity());
        if (isLogged)
            try {
                initEmpresaListFragment(mFacade.isLogged());
            } catch (Exception e) {
                e.printStackTrace();
            }
        else
            initViews();
    }

    public void setListener(IGoToEmpresa listener) {
        this.listener = listener;
    }

    private void initViews() {
        edtEmail = (EditText) mView.findViewById(R.id.edtEmail);
        edtSenha = (EditText) mView.findViewById(R.id.edtSenha);
        tvSenha = (TextView) mView.findViewById(R.id.tvSenha);
        tvConectado = (TextView) mView.findViewById(R.id.tvConectado);
        tvError = (TextView) mView.findViewById(R.id.txtError);
        btLogin = (Button) mView.findViewById(R.id.btLogin);
        CheckBox check = (CheckBox) mView.findViewById(R.id.chkConectado);
        check.setChecked(true);
        check.setVisibility(View.INVISIBLE);
        Typeface font = Typeface.createFromAsset(getActivity().getAssets(), "fonts/Raleway-Regular.ttf");
        edtEmail.setTypeface(font);
        edtSenha.setTypeface(font);
        tvConectado.setTypeface(font);
        btLogin.setTypeface(font);
        tvError.setTypeface(font);
        tvSenha.setTypeface(font);
        botaoEntrar();
        botaoSenha();
    }

    private void initEmpresaListFragment(Motorista motorista) throws Exception {
//        Intent intent = new Intent(getActivity(), EmpresasActivity.class);
//        Bundle bundle = new Bundle();
//        bundle.putParcelable(Motorista.PARCEL_MOTORISTA, motorista);
        mFacade.setLogged(motorista);
//        finishProgressBar();
        listener.onGoToNext();
//        startActivity(intent.putExtras(bundle));
    }

    private void botaoEntrar() {
        mView.findViewById(R.id.btLogin).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try {
                    if (mFacade.isConnected(getActivity()))
                        new AsyncTask<Void, Void, Motorista>() {
                            ProgressDialog progressDialog;
                            String email;
                            String senha;
                            String msg;

                            @Override
                            protected void onPreExecute() {
                                try {
                                    if (progressDialog == null) {
                                        progressDialog = new ProgressDialog(getActivity());
                                        progressDialog.setTitle("Aguarde...");
                                        progressDialog.setMessage("Autenticando dados.");
                                        progressDialog.setCanceledOnTouchOutside(false);
                                        if (!progressDialog.isShowing())
                                            progressDialog.show();
                                    }
                                    if (validarCampos())
                                        email = String.valueOf(((EditText) mView.findViewById(R.id.edtEmail)).getText());
                                    senha = String.valueOf(((EditText) mView.findViewById(R.id.edtSenha)).getText());
                                    mFacade.setMatenhaConectado(
                                            ((CheckBox) mView.findViewById(R.id.chkConectado)).isChecked()
                                    );
                                } catch (Exception e) {
                                    progressDialog = null;
                                    e.printStackTrace();
                                }
                            }

                            @Override
                            protected Motorista doInBackground(Void... strings) {
                                try {
                                    return mFacade.login(email, senha);
                                } catch (IllegalArgumentException | NullPointerException e) {
                                    msg = e.getMessage();
                                    return null;
                                }
                            }

                            @Override
                            protected void onPostExecute(Motorista motorista) {
                                try {
                                    if (motorista == null) {
                                        Toast.makeText(getActivity(), "Falha de autenticação, Email ou Senha Incorretos.", Toast.LENGTH_LONG).show();
                                        ((TextView) mView.findViewById(R.id.txtError)).setText(
                                                (msg.equals("")) ? getString(R.string.app_err_input_dadosIncorretos) : msg);
                                        mView.findViewById(R.id.txtError).setVisibility(View.VISIBLE);

//                                        edtEmail.setText("");
//                                        edtSenha.setText("");
//                                        check.setChecked(false);

                                    } else {
                                        mView.findViewById(R.id.txtError).setVisibility(View.GONE);
                                        initEmpresaListFragment(motorista);
                                    }
                                } catch (Exception e) {
                                    ((TextView) mView.findViewById(R.id.txtError)).setText(getString(R.string.app_err_input_dadosIncorretos));
                                    mView.findViewById(R.id.txtError).setVisibility(View.VISIBLE);
//                                    edtEmail.setText("");
//                                    edtSenha.setText("");
//                                    check.setChecked(false);
                                    e.printStackTrace();
                                } finally {
                                    try {
                                        if (progressDialog != null)
                                            if (progressDialog.isShowing())
                                                progressDialog.dismiss();
                                    } catch (Exception e) {
                                        progressDialog = null;
                                        e.printStackTrace();
                                    }
                                }
                            }
                        }.execute();
                    else {
                        Toast.makeText(getActivity(), getString(R.string.app_err_exc_semConexao), Toast.LENGTH_LONG).show();
                        ((TextView) mView.findViewById(R.id.txtError)).setText(getString(R.string.app_err_exc_semConexao));
                        mView.findViewById(R.id.txtError).setVisibility(View.VISIBLE);
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }

            }

        });

    }


    private void botaoSenha() {
        tvSenha.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getActivity(), SenhaActivitry.class));
            }
        });
    }

    private boolean validarCampos() {
        if (edtSenha.getText().toString().isEmpty()) {
            edtSenha.setError("Preencha o campo Senha");
            edtSenha.setFocusable(true);
            edtSenha.requestFocus();
            return false;
        } else if (edtSenha.getText().toString().length() <= 3) {
            edtSenha.setError("Informe uma senha com mais de 3 digitos");
            edtSenha.setFocusable(true);
            edtSenha.requestFocus();
            return false;
        } else if (edtEmail.getText().toString().isEmpty()) {
            edtEmail.setError("Preencha o campo Login");
            edtEmail.setFocusable(true);
            edtEmail.requestFocus();
            return false;
        } else if (!isValidEmail(edtEmail.getText().toString())) {
            edtEmail.setError("Informe um e-mail valido");
            edtEmail.setFocusable(true);
            edtEmail.requestFocus();
            return false;
        }


        return true;
    }

    public final static boolean isValidEmail(CharSequence target) {
        return !TextUtils.isEmpty(target) && android.util.Patterns.EMAIL_ADDRESS.matcher(target).matches();
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
}
