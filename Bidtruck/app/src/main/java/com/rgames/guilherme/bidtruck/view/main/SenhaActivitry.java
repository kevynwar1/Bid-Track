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
    String rec, subject, textMessage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_esqueceu_senha);

        edtEsqueceu = (EditText) findViewById(R.id.edtEsqueceu);
        btEnviar = (Button) findViewById(R.id.btEnviar);
        clickEnviar();

    }

    private void clickEnviar() {
        btEnviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                rec = edtEsqueceu.getText().toString();
                subject = "RECUPERAÃ‡Ã‚O DE SENHA";
                textMessage = "Sua Senha é :5678";

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

            class RetreiveFeedTask extends AsyncTask<String, Void, String> {

                @Override
                protected String doInBackground(String... params) {

                    try {
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
                    }
                    return null;
                }

                @Override
                protected void onPostExecute(String result) {
                    dialog.dismiss();
                    edtEsqueceu.setText("");
                    //msg.setText("");
                    //sub.setText("");
                    Toast.makeText(getApplicationContext(), "Mensangem Enviada", Toast.LENGTH_LONG).show();
                }
            }
        });
    }

}
