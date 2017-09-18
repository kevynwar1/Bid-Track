package com.rgames.guilherme.bidtruck.view.main;

import android.content.Intent;
import android.graphics.Typeface;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;

public class LoginActivity extends AppCompatActivity {

    private EditText edtSenha;
    private TextView tvSenha;
    private MyProgressBar myProgressBar;
    private Facade mFacade;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        verifyIsLogged();
    }

    private void verifyIsLogged() {
        mFacade = new Facade(LoginActivity.this);
        try {
            boolean chk = mFacade.isMatenhaConectado();
            ((CheckBox) findViewById(R.id.chkConectado)).setChecked(chk);
            Motorista motorista = mFacade.isLogged();
            if (mFacade.isConnected(LoginActivity.this)) {
                if (chk && (motorista != null && motorista.getCodigo() > 0))
                    initMainActivity(motorista);
                else initViews();
            } else
                initViews();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void initViews() {
        edtSenha = (EditText) findViewById(R.id.edtSenha);
        tvSenha = (TextView) findViewById(R.id.tvSenha);
        Typeface font = Typeface.createFromAsset(getAssets(), "fonts/museo500.otf");
        tvSenha.setTypeface(font);
        botaoEntrar();
        botaoSenha();
    }

    private void initMainActivity(Motorista motorista) throws Exception {
        Intent intent = new Intent(LoginActivity.this, MainActivity.class);
        Bundle bundle = new Bundle();
        bundle.putParcelable(motorista.PARCEL_MOTORISTA, motorista);
        mFacade.setLogged(motorista);
        startActivity(intent.putExtras(bundle));
        finishProgressBar();
        finish();
    }

    private void botaoEntrar() {
        findViewById(R.id.btLogin).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try {
                    if (mFacade.isConnected(LoginActivity.this))
                        new AsyncTask<Void, Void, Motorista>() {
                            String email;
                            String senha;
                            String msg;

                            @Override
                            protected void onPreExecute() {
                                try {
                                    initProgressBar();
                                    email = String.valueOf(((EditText) findViewById(R.id.edtEmail)).getText());
                                    senha = String.valueOf(((EditText) findViewById(R.id.edtSenha)).getText());
                                    mFacade.setMatenhaConectado(
                                            ((CheckBox) findViewById(R.id.chkConectado)).isChecked()
                                    );
                                } catch (Exception e) {
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
                                        Toast.makeText(LoginActivity.this, "Falha de autenticação, email e senha incorretos.", Toast.LENGTH_SHORT).show();
                                        ((TextView) findViewById(R.id.txtError)).setText(
                                                (msg.equals("")) ? getString(R.string.app_err_input_dadosIncorretos) : msg);
                                        findViewById(R.id.txtError).setVisibility(View.VISIBLE);
                                    } else {
                                        findViewById(R.id.txtError).setVisibility(View.GONE);
                                        initMainActivity(motorista);
                                    }
                                    finishProgressBar();
                                } catch (Exception e) {
                                    ((TextView) findViewById(R.id.txtError)).setText(getString(R.string.app_err_input_dadosIncorretos));
                                    findViewById(R.id.txtError).setVisibility(View.VISIBLE);
                                    e.printStackTrace();
                                }
                            }
                        }.execute();
                    else {
                        Toast.makeText(LoginActivity.this, getString(R.string.app_err_exc_semConexao), Toast.LENGTH_LONG).show();
                        ((TextView) findViewById(R.id.txtError)).setText(getString(R.string.app_err_exc_semConexao));
                        findViewById(R.id.txtError).setVisibility(View.VISIBLE);
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
                startActivity(new Intent(LoginActivity.this, SenhaActivitry.class));
            }
        });
    }

    @Override
    public void onBackPressed() {
        finish();
    }

    private void initProgressBar() throws ClassCastException, NullPointerException {
        if (myProgressBar == null)
            myProgressBar = new MyProgressBar((FrameLayout) findViewById(R.id.frame_progress));
    }

    private void finishProgressBar() throws Exception {
        if (myProgressBar != null) {
            myProgressBar.onFinish();
        }
    }
}
