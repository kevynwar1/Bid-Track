package com.rgames.guilherme.bidtruck.view.romaneios.entrega.pagerdetalhes.pager.ocorrencia;

import android.content.Intent;
import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.StaggeredGridLayoutManager;
import android.support.v7.widget.Toolbar;
import android.util.Base64;
import android.util.DisplayMetrics;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.FrameLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.controller.ControllerLogin;
import com.rgames.guilherme.bidtruck.controller.ControllerOcorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Entrega;
import com.rgames.guilherme.bidtruck.model.basic.MyProgressBar;
import com.rgames.guilherme.bidtruck.model.basic.Ocorrencia;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;
import com.rgames.guilherme.bidtruck.model.basic.TipoOcorrencia;
import com.rgames.guilherme.bidtruck.model.dao.http.HttpOcorrencia;
import com.rgames.guilherme.bidtruck.model.errors.EmpresaNullException;
import com.rgames.guilherme.bidtruck.view.fotos.activities.MultiCameraActivity;
import com.rgames.guilherme.bidtruck.view.fotos.adapters.CarregadorDeFoto;
import com.rgames.guilherme.bidtruck.view.fotos.adapters.GalleryImagesAdapter;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Constants;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Params;

import java.io.ByteArrayOutputStream;
import java.util.ArrayList;
import java.util.List;

public class OcorrenciaActivity extends AppCompatActivity {

    private int seq_entrega;
    private int romaneio;
    //    private Entrega entrega;
    private ControllerOcorrencia controllerOcorrencia;
    private ControllerLogin controllerLogin;
    private HttpOcorrencia httpOcorrencia;
    private MyProgressBar myProgressBar;
    private AdapterRecyclerTipoOcorrencia adapter;
    private RecyclerView rv;
    private int cod_ocorrencia;
    String codado;
    private ArrayList<Image> listImagem;
    private ArrayList<Image> lista;
    private ArrayList<String> test;
    private List<TipoOcorrencia> mListTipoOcorrencia;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_occurrence);
        try {
            if (getIntent().getExtras() != null) {
                seq_entrega = getIntent().getExtras().getInt(Entrega.PARCEL);
//                entrega = getIntent().getExtras().getParcelable(Entrega.PARCEL);
                romaneio = getIntent().getExtras().getInt(Romaneio.PARCEL);
                initToolbar();
                listImagem = new ArrayList<>();
                lista = new ArrayList<>();
           /*     test = new ArrayList<>();
                test.add("bola");
                test.add("bobo");
                test.add("roxao");*/
                httpOcorrencia = new HttpOcorrencia();
                controllerOcorrencia = new ControllerOcorrencia(this);
                controllerLogin = new ControllerLogin(OcorrenciaActivity.this);
            } else {
                onBackPressed();
                throw new NullPointerException("Dados não foram informados");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }


    @Override
    protected void onResume() {
        super.onResume();

        initFab();
        //  clickfloat();
        initList();
        // initButton();

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // int id = item.getItemId();
        switch (item.getItemId()) {
            case R.id.action_foto:
                clickfloat();
                return true;
            case R.id.action_enviar:
                initButton();
                return true;
            case android.R.id.home:
                onBackPressed();
                break;
        }

        return super.onOptionsItemSelected(item);
    }

    private void initButton() {

        new AsyncTask<Object, Object, Boolean>() {
            String descrip;

            @Override
            protected void onPreExecute() {
                initProgressBar();
                descrip = ((TextView) findViewById(R.id.edit_description)).getText().toString();
            }

            @Override
            protected Boolean doInBackground(Object... voids) {
                try {
                    return controllerOcorrencia.insert(new Ocorrencia(controllerLogin.getIdEmpresa()
                                    , seq_entrega
                                    , romaneio
                                    , adapter.getCodigoSelecionado()
                                    , descrip)
                            , listImagem);
                } catch (final Exception e) {
                    e.printStackTrace();
                    OcorrenciaActivity.this.runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            Toast.makeText(OcorrenciaActivity.this, e.getMessage(), Toast.LENGTH_LONG).show();
                        }
                    });
                    return null;
                }
            }

            @Override
            protected void onPostExecute(Boolean aBoolean) {
                try {
                    if (aBoolean) {
                        //cod_ocorrencia = aBoolean;
                        Toast.makeText(OcorrenciaActivity.this, "Ocorrência cadastrada.", Toast.LENGTH_LONG).show();
                        onBackPressed();
                    } else {
                        Toast.makeText(OcorrenciaActivity.this, "Falha ao tentar cadastrar a ocorrência.", Toast.LENGTH_LONG).show();
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                } finally {
                    try {
                        finishProgressBar();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
            }
        }.execute();
        // initFoto();


    }

    private void initList() {
        new AsyncTask<Void, Void, List<TipoOcorrencia>>() {
            String msg = "";

            @Override
            protected void onPreExecute() {
                initProgressBar();
            }

            @Override
            protected List<TipoOcorrencia> doInBackground(Void... voids) {
                try {
                    return controllerOcorrencia.selectTipo(controllerLogin.getIdEmpresa());
                } catch (EmpresaNullException e) {
                    e.printStackTrace();
                    return null;
                }
            }

            @Override
            protected void onPostExecute(List<TipoOcorrencia> tipoOcorrencia) {
                try {
                    if (tipoOcorrencia != null && tipoOcorrencia.size() > 0 && msg.equals("")) {
                        RecyclerView recyclerView = (RecyclerView) findViewById(R.id.recyclerview);
                        recyclerView.setLayoutManager(new LinearLayoutManager(OcorrenciaActivity.this));
                        mListTipoOcorrencia = tipoOcorrencia;
                        adapter = new AdapterRecyclerTipoOcorrencia(tipoOcorrencia);
                        recyclerView.setAdapter(adapter);
                    } else
                        initEmpty(false);
                } catch (Exception e) {
                    e.printStackTrace();
                } finally {
                    try {
                        finishProgressBar();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
            }
        }.execute();
    }

    private void initEmpty(boolean b) {
        findViewById(R.id.txt_empty).setVisibility((b) ? View.VISIBLE : View.GONE);
    }

    private void initFab() {
        rv = (RecyclerView) findViewById(R.id.rv_photo);
    }

    private void clickfloat() {

        Intent intent = new Intent(OcorrenciaActivity.this, MultiCameraActivity.class);
        Params params = new Params();
        params.setCaptureLimit(10);
        intent.putExtra(Constants.KEY_PARAMS, params);
        startActivityForResult(intent, Constants.TYPE_MULTI_CAPTURE);

    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode != RESULT_OK) {
            return;
        }
        switch (requestCode) {
            case Constants.TYPE_MULTI_CAPTURE:
                handleResponseIntent(data);
                break;

        }
    }

    private int getColumnCount() {
        DisplayMetrics displayMetrics = getResources().getDisplayMetrics();
        float dpWidth = displayMetrics.widthPixels / displayMetrics.density;
        float thumbnailDpWidth = getResources().getDimension(R.dimen.thumbnail_width) / displayMetrics.density;
        return (int) (dpWidth / thumbnailDpWidth);
    }

    private void handleResponseIntent(Intent intent) {
        try {
            ArrayList<Image> imagesList = intent.getParcelableArrayListExtra(Constants.KEY_BUNDLE_LIST);


            for (int i = 0; i < imagesList.size(); i++) {
                String caminho = imagesList.get(i).getImagePath();
                //Bitmap bit = BitmapFactory.decodeFile(caminho);
                Bitmap bit = CarregadorDeFoto.carrega(caminho);
                Bitmap bito = Bitmap.createScaledBitmap(bit, 300, 300, true);
                ByteArrayOutputStream stream = new ByteArrayOutputStream();
                bito.compress(Bitmap.CompressFormat.JPEG, 55, stream);
                byte[] fotoB = stream.toByteArray();
                codado = Base64.encodeToString(fotoB, Base64.DEFAULT);
                listImagem.add(new Image(imagesList.get(i)._id, imagesList.get(i).uri, codado, imagesList.get(i).isPortraitImage));
            }

            rv.setHasFixedSize(true);
            StaggeredGridLayoutManager mLayoutManager = new StaggeredGridLayoutManager(getColumnCount(), GridLayoutManager.VERTICAL);
            mLayoutManager.setGapStrategy(StaggeredGridLayoutManager.GAP_HANDLING_MOVE_ITEMS_BETWEEN_SPANS);
            rv.setLayoutManager(mLayoutManager);
            GalleryImagesAdapter imageAdapter = new GalleryImagesAdapter(this, imagesList, getColumnCount(), new Params());
            rv.setAdapter(imageAdapter);
        } catch (Exception e) {
            e.printStackTrace();
            Toast.makeText(this, e.getMessage(), Toast.LENGTH_SHORT).show();
        }
    }

    private void initToolbar() throws Exception {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
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

//    /*private void initFoto() {
//        new AsyncTask<Void, Void, Boolean>() {
//<<<<<<< HEAD
////            ProgressDialog dialog;
//=======
//            // ProgressDialog dialog;
//>>>>>>> c5723bfb79b9c2d56c3016d70e0221540f25ce73
//            String msg = "";
//
//            @Override
//            protected void onPreExecute() {
////                    dialog = ProgressDialog.show(OcorrenciaActivity.this, "fotos", "Enviando Fotos", true);
//            }
//
//            @Override
//            protected Boolean doInBackground(Void... voids) {
//                try {
//                    if (listImagem != null) {
//                        return httpImagem.insert(cod_ocorrencia, listImagem);
//                    }
//                } catch (Exception e) {
//                    e.printStackTrace();
//                    msg = e.getMessage();
//                }
//
//                return false;
//            }
//
//            @Override
//            protected void onPostExecute(Boolean aBoolean) {
//<<<<<<< HEAD
////                dialog.dismiss();
//                try {
//                    if (msg.equals(""))
//                        if (!aBoolean) {
//                          /*  Toast.makeText(OcorrenciaActivity.this, "Foto Enviada.", Toast.LENGTH_LONG).show();
//                            onBackPressed();*/
//                            Toast.makeText(OcorrenciaActivity.this, "Falha ao tentar cadastrar a foto.", Toast.LENGTH_LONG).show();
//                        } else
//                            Toast.makeText(OcorrenciaActivity.this, msg, Toast.LENGTH_LONG).show();
//=======
//                //   dialog.dismiss();
//                try {
//                    //  if (msg.equals(""))
//                    if (aBoolean == false) {
//                            Toast.makeText(OcorrenciaActivity.this, "Foto Enviada.", Toast.LENGTH_LONG).show();
//                            onBackPressed();
//                        Toast.makeText(OcorrenciaActivity.this, "Falha ao tentar cadastrar a foto.", Toast.LENGTH_LONG).show();
//                    } //else
////                            Toast.makeText(OcorrenciaActivity.this, msg, Toast.LENGTH_LONG).show();
//>>>>>>> c5723bfb79b9c2d56c3016d70e0221540f25ce73
//                } catch (Exception e) {
//                    e.printStackTrace();
//                }
//            }
//        }.execute();
//
//
//    }*/
}
