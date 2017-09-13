package com.rgames.guilherme.bidtruck.view.main;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.facade.Facade;
import com.rgames.guilherme.bidtruck.model.basic.Motorista;
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
            finish();
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
            case R.id.action_logout:
                try {
                    AlertDialog alertDialog = new AlertDialog.Builder(this).create();
                    alertDialog.setTitle(getString(R.string.app_name));
                    alertDialog.setMessage("Deseja sair do app?");
                    alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE
                            , getString(R.string.app_dlg_cancel)
                            , new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {
                                    dialogInterface.dismiss();
                                }
                            });
                    alertDialog.setButton(AlertDialog.BUTTON_POSITIVE
                            , getString(R.string.app_dlg_confirm)
                            , new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {
                                    try {
                                        Facade facade = new Facade(MainActivity.this);
                                        facade.setLogged(new Motorista(0,0));
                                        startActivity(new Intent(MainActivity.this, LoginActivity.class));
                                        finish();
                                    } catch (Exception e) {
                                        e.printStackTrace();
                                    } finally {
                                        dialogInterface.dismiss();
                                    }
                                }
                            });
                    alertDialog.show();
                } catch (Exception e) {
                    e.printStackTrace();
                }
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