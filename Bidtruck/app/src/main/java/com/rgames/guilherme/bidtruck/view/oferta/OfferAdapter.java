package com.rgames.guilherme.bidtruck.view.oferta;

import android.content.Context;
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

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.DecimalFormat;
import java.util.List;

public class OfferAdapter extends ArrayAdapter<Romaneio> {

    private Context context;
    private List<Romaneio> offers;
    private int pesoTotal;
    private String mcidadeD, mestadoD;
    String distanciaa;
    String mCidadeOrigem, mEstadoOrigem;
    String mCidadeDestino, mEstadoDestino;
    String recebido;

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
            WebService apii = new WebService();
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.lista_oferta, parent, false);
            TextView code = view.findViewById(R.id.cod_oferta);
            TextView payment = view.findViewById(R.id.dinheiro_oferta);
            TextView peso = view.findViewById(R.id.peso_oferta);
            TextView estadoO = view.findViewById(R.id.tvEstadoO);
            TextView cidadeO = view.findViewById(R.id.tvCidadeO);
            TextView estadoD = view.findViewById(R.id.tvEstadoD);
            TextView cidadeD = view.findViewById(R.id.tvCidadeD);
              TextView distancia = view.findViewById(R.id.tvDistancia);
            ImageView imagem = view.findViewById(R.id.thumbnail2);

            Context contextx = imagem.getContext();
            Romaneio offer = offers.get(position);

            String test = offer.getEstabelecimento().getLogradouro();
            String maria = offer.getEstabelecimento().getBairro();
            String fof = maria.replace(" ", "+");
            String bob = test.replace(" ", "+");
            String urlimagem = "https://maps.googleapis.com/maps/api/staticmap?center=" + bob + fof + "&markers=color:red%7C" + bob + fof + "&size=640x400&key=AIzaSyCCqyCKlw5Hj3hvPbMQ1C9OPyvcQQBhARU";
            Picasso.with(contextx)
                    .load(urlimagem)
                    .into(imagem);

            for (Entrega entrega : offer.getEntregaList()) {
                String[] separandoPesos = entrega.getPeso().split(" ");
                pesoTotal = +Integer.parseInt(separandoPesos[0]);
            }

            Entrega mentrega = offer.getEntregaList().get(offer.getEntregaList().size() - 1);
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
            apii.execute();


            estadoO.setText(offer.getEstabelecimento().getUf());
            cidadeO.setText(offer.getEstabelecimento().getCidade());
            estadoD.setText(mestadoD);
            cidadeD.setText(mcidadeD);
            distancia.setText(recebido);

            code.setText(Integer.toString(offer.getCodigo()));
            peso.setText(Integer.toString(pesoTotal) + " KG");
            DecimalFormat df = new DecimalFormat("#,##0.00");
            payment.setText("R$ " + df.format(offer.getValor()));

        }
        return view;
    }

// ERICK DA UMA OLHADA NESSE ASYNC NO OnPOSTEXECUTE ELE SO ENTRA NO CATCH
    public class WebService extends AsyncTask<String, Void, JSONObject> {


        @Override
        protected JSONObject doInBackground(String... params) {
            try {

                URL mUrl = new URL("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" + mCidadeOrigem + "," + mEstadoOrigem + "&destinations=" + mCidadeDestino + "," + mEstadoDestino + "&key=AIzaSyCCqyCKlw5Hj3hvPbMQ1C9OPyvcQQBhARU");
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

                JSONObject object2 = s.getJSONObject("distance");
                recebido = object2.getString("text");
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

}