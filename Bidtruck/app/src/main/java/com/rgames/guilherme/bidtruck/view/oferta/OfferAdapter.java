package com.rgames.guilherme.bidtruck.view.oferta;

import android.content.Context;
import android.graphics.Typeface;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.squareup.picasso.Picasso;


import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.DecimalFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

public class OfferAdapter extends ArrayAdapter<Romaneio> {

    private Context context;
    private List<Romaneio> offers;
    private int pesoTotal;
    private String mcidadeD, mestadoD;
    String mCidadeOrigem, mEstadoOrigem;
    String mCidadeDestino, mEstadoDestino;
    String recebido, dur;
    Romaneio offer;

    public OfferAdapter(Context c, List<Romaneio> list) {
        super(c, 0, list);
        this.context = c;
        this.offers = list;
    }


    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = null;
        if (offers != null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.lista_oferta, parent, false);
            offer = offers.get(position);

            ImageView imagem = view.findViewById(R.id.thumbnail2);
            // TextView code = view.findViewById(R.id.cod_oferta);
            TextView payment = view.findViewById(R.id.tvDinheiro);
            TextView peso = view.findViewById(R.id.tvPeso);
            TextView origem = view.findViewById(R.id.tvOrigem);
            TextView destino = view.findViewById(R.id.tvDestino);
            TextView distancia = view.findViewById(R.id.tvDistancia);
            TextView duracao = view.findViewById(R.id.tvDuracao);
            TextView rs = view.findViewById(R.id.tvRS);
            TextView duracao2 = view.findViewById(R.id.tvDuracao2);
            TextView distancia2 = view.findViewById(R.id.tvDistancia2);
            TextView peso2 = view.findViewById(R.id.tvPeso2);


            Typeface font = Typeface.createFromAsset(getContext().getAssets(), "fonts/roboto.regular.ttf");
            payment.setTypeface(font);
            peso.setTypeface(font);
            origem.setTypeface(font);
            destino.setTypeface(font);
            distancia.setTypeface(font);
            duracao.setTypeface(font);
            duracao2.setTypeface(font);
            distancia2.setTypeface(font);
            peso2.setTypeface(font);

            Context contextx = imagem.getContext();
            String logradouro = offer.getEstabelecimento().getLogradouro();
            String bairro = offer.getEstabelecimento().getBairro();
            String mBairro = bairro.replace(" ", "+");
            String mLogradouro = logradouro.replace(" ", "+");
            String urlimagem = "https://maps.googleapis.com/maps/api/staticmap?center=" + mLogradouro + mBairro + "&markers=color:red%7C" + mLogradouro + mBairro + "&size=640x400&key=AIzaSyCCqyCKlw5Hj3hvPbMQ1C9OPyvcQQBhARU";
            Picasso.with(contextx)
                    .load(urlimagem)
                    .into(imagem);


            for (Entrega entrega : offer.getEntregaList()) {
                String[] separandoPesos = entrega.getPeso().split(" ");
                pesoTotal = +Integer.parseInt(separandoPesos[0]);
            }

            Entrega mentrega = offer.getEntregaList().get(offer.getEntregaList().size() - 1);

           for (int i = 0; i < offers.size(); i ++) {
               String CidadeOrigem = offer.getEstabelecimento().getCidade();
               String EstadoOrigem = offer.getEstabelecimento().getUf();
               mEstadoOrigem = EstadoOrigem.replace(" ", "+");
               mCidadeOrigem = CidadeOrigem.replace(" ", "+");

               String CidadeDestino = mentrega.getDestinatario().getCidade();
               String EstadoDestino = mentrega.getDestinatario().getUF();
               mEstadoDestino = EstadoDestino.replace(" ", "+");
               mCidadeDestino = CidadeDestino.replace(" ", "+");


               mcidadeD = mentrega.getDestinatario().getCidade();
               mestadoD = mentrega.getDestinatario().getUF();
               String urldistancia = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" + mCidadeOrigem + "," + mEstadoOrigem + "&destinations=" + mCidadeDestino + "," + mEstadoDestino + "&key=AIzaSyCCqyCKlw5Hj3hvPbMQ1C9OPyvcQQBhARU";
               WebService task = new WebService(getContext(), distancia, urldistancia);
               task.execute();
           }
            origem.setText(offer.getEstabelecimento().getCidade() + " - " + offer.getEstabelecimento().getUf());
            destino.setText(mentrega.getDestinatario().getCidade() + " - " + mentrega.getDestinatario().getUF());


            try {
                String recebeData = retornaData(offer.getData_oferta());
                duracao.setText(recebeData);
            } catch (ParseException e) {
                e.printStackTrace();
            }

            //code.setText(Integer.toString(offer.getCodigo()));
            peso.setText(Integer.toString(pesoTotal) + " kg");
            DecimalFormat df = new DecimalFormat("#,##0.00");
            payment.setText(df.format(offer.getValor()));

        }
        return view;
    }


    public class WebService extends AsyncTask<String, Void, JSONObject> {
        Context mContext;
        TextView view;
        String url;

        public WebService(Context mContext, TextView v, String url) {
            this.mContext = mContext;
            this.view = v;
            this.url = url;

        }

        @Override
        protected JSONObject doInBackground(String... params) {
            try {

                URL mUrl = new URL(url);
                HttpURLConnection httpConnection = (HttpURLConnection) mUrl.openConnection();
                httpConnection.setRequestMethod("GET");
                httpConnection.setRequestProperty("Content-length", "0");
                httpConnection.setUseCaches(false);
                httpConnection.setAllowUserInteraction(false);
                httpConnection.setConnectTimeout(100000);
                httpConnection.setReadTimeout(100000);

                httpConnection.connect();

                int responseCode = httpConnection.getResponseCode();

                if (responseCode == HttpURLConnection.HTTP_OK) {
                    BufferedReader br = new BufferedReader(new InputStreamReader(httpConnection.getInputStream()));
                    StringBuilder sb = new StringBuilder();
                    String line;
                    while ((line = br.readLine()) != null) {
                        sb.append(line + "\n");
                    }
                    br.close();
                    String json = sb.toString();
                    JSONObject jsonObject = new JSONObject(json);
                    return jsonObject;
                }
            } catch (IOException e) {
                e.printStackTrace();
            } catch (Exception ex) {
                ex.printStackTrace();
            }
            return null;

        }

        @Override
        protected void onPostExecute(JSONObject s) {
            super.onPostExecute(s);
            try {


                recebido = s.getJSONArray("rows").getJSONObject(0).getJSONArray("elements").getJSONObject(0).getJSONObject("distance").getString("text");

                // dur = s.getJSONArray("rows").getJSONObject(0).getJSONArray("elements").getJSONObject(0).getJSONObject("duration").getString("text");

                view.setText(recebido);
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

    public String retornaData(String oferta) throws ParseException {
        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Date data = new Date();

        Calendar cal = Calendar.getInstance();
        String datas = new SimpleDateFormat("yyyy-MM-dd").format(data);
        String hora = new SimpleDateFormat("HH:mm:ss").format(data);
        cal.setTime(dateFormat.parse(datas + " " + hora));

        Calendar calOferta = Calendar.getInstance();
        calOferta.setTime(dateFormat.parse(oferta));

        long divisao = cal.getTimeInMillis() - calOferta.getTimeInMillis();
        long diffMinutos = (divisao) / (60 * 1000);
        long hours = (60 * 60 * 1000);
        long diffHoras = divisao / hours;
      //  long diffHorasMinutos = (divisao % hours) / (60 * 1000);
        long diffDias = (divisao /1000) / 60 / 60 /24;
        if (divisao < 86400000)
            return diffHoras + " Horas";
        else if (divisao < 3600000)
            return diffMinutos + " Minutos";
        else
            return diffDias + " Dias";
    }
}

