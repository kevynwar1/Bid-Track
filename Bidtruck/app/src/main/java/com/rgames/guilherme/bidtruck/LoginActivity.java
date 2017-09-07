package com.rgames.guilherme.bidtruck;

import android.content.Intent;
import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class LoginActivity extends AppCompatActivity {
 private EditText edtEmail;
    private EditText edtSenha;
    private Button btLogin;
    private TextView tvSenha;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        edtEmail = (EditText) findViewById(R.id.edtEmail);
        edtSenha = (EditText) findViewById(R.id.edtSenha);
        btLogin = (Button) findViewById(R.id.btLogin);
        tvSenha = (TextView) findViewById(R.id.tvSenha);
        Typeface font = Typeface.createFromAsset(getAssets(),"fonts/museo500.otf");
        tvSenha.setTypeface(font);
        botaoEntrar();
        botaoSenha();
    }
    private void botaoEntrar(){
        btLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                startActivity(intent);
            }
        });
    }
    private void botaoSenha(){
        tvSenha.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(LoginActivity.this, SenhaActivitry.class);
                startActivity(intent);
            }
        });
    }
}
