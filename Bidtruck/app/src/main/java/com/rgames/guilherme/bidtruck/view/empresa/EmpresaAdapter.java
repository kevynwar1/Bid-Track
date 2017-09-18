package com.rgames.guilherme.bidtruck.view.empresa;

import android.content.Context;
import android.support.annotation.LayoutRes;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.rgames.guilherme.bidtruck.R;
import com.rgames.guilherme.bidtruck.model.basic.Empresa;
import com.rgames.guilherme.bidtruck.model.basic.Romaneio;

import java.util.List;

/**
 * Created by kevyn on 18/09/2017.
 */

public class EmpresaAdapter extends ArrayAdapter<Empresa> {

    private Context context;
    private List<Empresa> empresas;

    public EmpresaAdapter(@NonNull Context context, List<Empresa> list) {
        super(context, 0, list);
        this.context = context;
        this.empresas = list;
    }

    @Override
    public int getCount() {
        return empresas.size();
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = null;
        if(empresas != null){
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.adapter_empresa, parent, false);
            TextView tvEmpresa = (TextView) view.findViewById(R.id.tvEmpresa);
            Empresa empresa = empresas.get(position);
            tvEmpresa.setText((empresa.getNome_fantasia()));
        }
        return view;
    }
}
