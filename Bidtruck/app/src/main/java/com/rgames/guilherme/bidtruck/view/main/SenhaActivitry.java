package com.rgames.guilherme.bidtruck.view.main;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Usuario;

import org.json.JSONObject;

import java.util.Properties;

import javax.mail.Authenticator;
import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

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


                rec = edtEsqueceu.getText().toString();

                Properties props = new Properties();
                props.put("mail.smtp.host", "smtp.gmail.com");
                props.put("mail.smtp.socketFactory.port", "465");
                props.put("mail.smtp.socketFactory.class", "javax.net.ssl.SSLSocketFactory");
                props.put("mail.smtp.auth", "true");
                props.put("mail.smtp.port", "465");

                session = Session.getDefaultInstance(props, new Authenticator() {
                    protected PasswordAuthentication getPasswordAuthentication() {
                        return new PasswordAuthentication("kevynh48@gmail.com", "s1ec009178");
                    }
                });

                dialog = ProgressDialog.show(SenhaActivitry.this, "", "Enviando Email...", true);

                RetreiveFeedTask task = new RetreiveFeedTask();
                task.execute();
            }

            class RetreiveFeedTask extends AsyncTask<String, Object, Usuario> {

                @Override
                protected Usuario doInBackground(String... params) {
                   /* try {
                        Message message = new MimeMessage(session);
                        message.setFrom(new InternetAddress("kevynh48@gmail.com"));
                        message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(rec));
                        message.setSubject(subject);
                        message.setContent(textMessage, "text/html; charset=utf-8");
                        Transport.send(message);
                    } catch (MessagingException e) {
                        e.printStackTrace();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }*/

                    try {
                        return mFacade.login(rec);

                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                    return null;
                }


                @Override
                protected void onPostExecute(Usuario result) {
                    dialog.dismiss();
                    if (result.getSenha() != null) {
                        EnviarM envia = new EnviarM(result.getSenha().toString());
                        envia.execute();

                    } else {
                        Toast.makeText(SenhaActivitry.this, "Email Invalido", Toast.LENGTH_LONG).show();
                    }

                }
            }
        });
    }

    class EnviarM extends AsyncTask<String, Void, String> {

        private String stringss;

        public EnviarM(String s) {
            stringss = s;
        }

        @Override
        protected String doInBackground(String... strings) {

            try {
                Message message = new MimeMessage(session);
                message.setFrom(new InternetAddress("kevynh48@gmail.com"));
                message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(rec));
                message.setSubject("Recuperação de Senha");
                message.setContent("Sua senha é :" + stringss, "text/html; charset=utf-8");
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
                 /*   if (result.getSenha() != null) {
                        enviar(result.getSenha().toString());
                        Toast.makeText(getApplicationContext(), "Mensagem Enviada", Toast.LENGTH_LONG).show();
                        edtEsqueceu.setText("");
                    }*/

            //msg.setText("");
            //sub.setText("");
            Toast.makeText(getApplicationContext(), "Mensagem Enviada", Toast.LENGTH_LONG).show();
        }

    }


  /*  private Message enviar(String senha) {
        try {
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress("kevynh48@gmail.com"));
            message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(rec));
            message.setSubject("Recuperar Senha");
            message.setContent(senha, "text/plain; charset=utf-8");
            Transport.send(message);
            return message;
        } catch (MessagingException e) {
            e.printStackTrace();
        } catch (Exception e) {
            e.printStackTrace();
        }
        return null;
    }*/


}
