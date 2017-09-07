package com.rgames.guilherme.bidtruck;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.view.romaneios.RomaneioFragment;
import com.rgames.guilherme.bidtruck.view.mensagens.MensagensFragment;
import com.rgames.guilherme.bidtruck.view.ocorrencia.OcorrenciaFragment;
import com.rgames.guilherme.bidtruck.view.sincronizacao.SincronizacaoFragment;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        try {
            init();
        } catch (Exception e) {
            e.printStackTrace();
        }
        if (savedInstanceState == null)
            getSupportFragmentManager().beginTransaction().add(R.id.content_main, RomaneioFragment.newInstance()).commit();
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_settings:
                return true;
            case R.id.action_net:
                new AsyncTask<Void, Void, String>() {
                    @Override
                    protected String doInBackground(Void... voids) {
                        Facade facade = new Facade(MainActivity.this);
                        return facade.connectionTest();
                    }

                    @Override
                    protected void onPostExecute(String aVoid) {
                        Toast.makeText(MainActivity.this, aVoid, Toast.LENGTH_SHORT).show();
                    }
                }.execute();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        onCloseDrawer();
        switch (item.getItemId()) {
            case R.id.nav_entrega:
                getSupportFragmentManager().beginTransaction().replace(R.id.content_main, RomaneioFragment.newInstance()).commit();
                return true;
            case R.id.nav_sync:
                getSupportFragmentManager().beginTransaction().replace(R.id.content_main, SincronizacaoFragment.newInstance()).commit();
                return true;
            case R.id.nav_ocorr:
                getSupportFragmentManager().beginTransaction().replace(R.id.content_main, OcorrenciaFragment.newInstance()).commit();
                return true;
            case R.id.nav_msg:
                getSupportFragmentManager().beginTransaction().replace(R.id.content_main, MensagensFragment.newInstance()).commit();
                return true;
            default:
                return true;
        }
    }

    private void onCloseDrawer() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
    }

    private void init() throws Exception {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
    }
}