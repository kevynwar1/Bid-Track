package com.rgames.guilherme.bidtruck.view.fotos.adapters;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Matrix;
import android.media.ExifInterface;

import java.io.IOException;

/**
 * Created by Kevyn on 14/10/2017.
 */

public class CarregadorDeFoto {
    public static Bitmap carrega(String caminhoFoto) throws IOException {
        ExifInterface exif = new ExifInterface(caminhoFoto);
        String orientacao = exif.getAttribute(ExifInterface.TAG_ORIENTATION);
        int codigoOrientacao = Integer.parseInt(orientacao);

        switch (codigoOrientacao) {
            case ExifInterface.ORIENTATION_NORMAL:
                return abreFotoERotaciona(caminhoFoto, 0);
            case ExifInterface.ORIENTATION_ROTATE_90:
                return abreFotoERotaciona(caminhoFoto, 90);
            case ExifInterface.ORIENTATION_ROTATE_180:
                return abreFotoERotaciona(caminhoFoto, 180);
            case ExifInterface.ORIENTATION_ROTATE_270:
                return abreFotoERotaciona(caminhoFoto, 270);
        }
        return null;
    }

    private static Bitmap abreFotoERotaciona(String caminhoFoto, int angulo) {
        // Abre o bitmap a partir do caminho da foto
        Bitmap bitmap = BitmapFactory.decodeFile(caminhoFoto);

        // Prepara a operação de rotação com o ângulo escolhido
        Matrix matrix = new Matrix();
        matrix.postRotate(angulo);

        // Cria um novo bitmap a partir do original já com a rotação aplicada
        return Bitmap.createBitmap(bitmap, 0, 0,
                bitmap.getWidth(), bitmap.getHeight(),
                matrix, true);
    }
}

