package com.rgames.guilherme.bidtruck.view.main;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Properties;

import javax.mail.Authenticator;
import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Multipart;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeMultipart;

public class SenhaActivitry extends AppCompatActivity {
    Session session = null;
    ProgressDialog dialog = null;
    EditText edtEsqueceu;
    Button btEnviar;
    Facade mFacade;
    String rec, subject, textMessage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_esqueceu_senha);
        mFacade = new Facade(SenhaActivitry.this);
        edtEsqueceu = (EditText) findViewById(R.id.edtEsqueceu);
        btEnviar = (Button) findViewById(R.id.btEnviar);
        clickEnviar();

    }

    private void clickEnviar() {
        btEnviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                dialog = ProgressDialog.show(SenhaActivitry.this, "", "Verificando Dados...", true);
                //   if (validaCampos() == true)
                rec = edtEsqueceu.getText().toString();


                Properties props = new Properties();
                props.put("mail.smtp.host", "smtp.gmail.com");
                props.put("mail.smtp.socketFactory.port", "465");
                props.put("mail.smtp.socketFactory.class", "javax.net.ssl.SSLSocketFactory");
                props.put("mail.smtp.auth", "true");
                props.put("mail.smtp.port", "465");

                session = Session.getDefaultInstance(props, new Authenticator() {
                    protected PasswordAuthentication getPasswordAuthentication() {
                        return new PasswordAuthentication("bidtrack7@gmail.com", "34848461");
                    }
                });


                RetreiveFeedTask task = new RetreiveFeedTask();
                task.execute();
            }

            class RetreiveFeedTask extends AsyncTask<Object, Object, Motorista> {

                @Override
                protected Motorista doInBackground(Object... params) {

                    try {
                        return mFacade.senha(rec);

                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                    return null;
                }


                @Override
                protected void onPostExecute(Motorista result) {
                    dialog.dismiss();
                    try {
                        if (result.getSenha() != null) {
                            dialog = ProgressDialog.show(SenhaActivitry.this, "", "Enviando Email...", true);
                            EnviarM envia = new EnviarM(result.getSenha().toString(), result.getNome().toString(), result.getEmail().toString());
                            envia.execute();

                        } else {
                            Toast.makeText(SenhaActivitry.this, "Email Invalido", Toast.LENGTH_LONG).show();
                            edtEsqueceu.setText("");
                        }
                    } catch (Exception e) {
                        Toast.makeText(SenhaActivitry.this, "Email Inválido", Toast.LENGTH_LONG).show();
                        edtEsqueceu.setText("");
                    }

                }
            }
        });
    }

    class EnviarM extends AsyncTask<String, Void, String> {

        private String stringss;
        private String nomes;
        private String email;

        public EnviarM(String s, String nome, String email) {
            stringss = s;
            nomes = nome;
            this.email = email;

        }

        @Override
        protected String doInBackground(String... strings) {

            try {

                Message message = new MimeMessage(session);
                message.setFrom(new InternetAddress("bidtrack7@gmail.com"));
                message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(rec));
                message.setSubject("Recuperação de Senha");
                MimeBodyPart textPart = new MimeBodyPart();
                textPart.setContent(htmlMessage(nomes, stringss, email), "text/html");
                Multipart mps = new MimeMultipart();
                mps.addBodyPart(textPart);
                //message.setContent("Recuperação de Acesso do usuário " + nomes + ", " + "sua senha é: " + stringss, "text/html; charset=utf-8");
                message.setContent(mps);
                Transport.send(message);
            } catch (MessagingException e) {
                e.printStackTrace();
            } catch (Exception e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String result) {
            dialog.dismiss();

            Toast.makeText(getApplicationContext(), "Mensagem Enviada", Toast.LENGTH_LONG).show();
            finish();
        }

    }

    private boolean validaCampos() {
        if (!isValidEmail(edtEsqueceu.getText().toString())) {
            edtEsqueceu.setError("Informe um e-mail valido");
            edtEsqueceu.setFocusable(true);
            edtEsqueceu.requestFocus();
            return false;
        }
        return true;
    }

    public final static boolean isValidEmail(CharSequence target) {
        return !TextUtils.isEmpty(target) && android.util.Patterns.EMAIL_ADDRESS.matcher(target).matches();
    }

    private static String htmlMessage(String nome, String senha, String email) {
        String maria = "Olá " + "<b>" + nome + "</b>" + "<br>" +
               // "Bem-vindo à <em>Bid & Track.</em><br>" +
                "Agradecemos por utilizar nossa plataforma.<br><br>" +
                "<b>Os dados da sua conta estão logo abaixo:</b><br><br>" +
                "E-mail: " + email + "<br>" +
                "Senha: " + senha;

        SimpleDateFormat dateFormat_hora = new SimpleDateFormat("HH:mm");
        Date data = new Date();
        Calendar cal = Calendar.getInstance();
        cal.setTime(data);
        Date data_atual = cal.getTime();

        String hora_atual = dateFormat_hora.format(data_atual);
        String traço = "—";

        return "<html>" +
                " <meta charset=UTF-8>" +
                "<div style='padding: 50px 70px 50px 70px; color: #FFF; background: #F1F1F1'>" +
                "<table width='100%' border='0' cellpadding='0' cellspacing='0' style='box-shadow: 0 0 30px rgba(204,204,204, 0.57);'>" +
                "<tr>" +
                "<td align='center' width='20%' style='background: #FFF; padding: 10px'>" +
                "<img src='http://coopera.pe.hu/assets/img/bid-track-solid-ico.png' alt='Bid & Track'>" +
                "</td>" +
                "<td style='background: #FFF; color: #000; padding-left: 50px; padding: 20px;'>" +
                "<span style='font-size: 27px'>Acesso Bid & Track</span><br><br>" +
                maria + "<br>" +
                "<br><br>" +
                "<hr style='border: 0; height: 1px; background-color: #EAEAEA;'>" +
                "<span style='color: #CCC'>" + hora_atual + " contato@coopera.pe.hu</span>" +
                "<hr style='border: 0; height: 1px; background-color: #EAEAEA;'>" +
                "Abraço,<br>" +
                "Equipe Bid & Track." +
                "</td>" +
                "</tr>" +
                "</table>" +
                "<br>" +
                "<span style='color:#999'>" +
                "<a href='\".base_url().\"' style='color:#999'>Bid & Track</a>" +
                "</span>" +
                "</div>" +
                "</html>";
    }


}
