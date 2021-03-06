package com.rgames.guilherme.bidtruck.view.fotos.adapters;

import android.app.Activity;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Point;
import android.graphics.drawable.ColorDrawable;
import android.support.v7.widget.RecyclerView;
import android.view.Display;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.RelativeLayout;

import com.rgames.guilherme.bidtruck.R;
import com.squareup.picasso.Picasso;
//import com.vlk.multimager.activities.GalleryActivity;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Image;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Params;
import com.rgames.guilherme.bidtruck.view.fotos.utils.Utils;
import com.rgames.guilherme.bidtruck.view.fotos.views.AutoImageView;

import java.io.IOException;
import java.util.ArrayList;

/**
 * Created by vansikrishna on 08/06/2016.
 */
public class GalleryImagesAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {

    ArrayList<Image> list;
    Activity activity;
    int columnCount;
    private ArrayList<Long> selectedIDs;
    private int screenWidth;
    private View.OnClickListener onClickListener;
    Params params;

    public GalleryImagesAdapter(Activity activity, ArrayList<Image> list, int columnCount, Params params) {
        this.activity = activity;
        this.list = list;
        this.columnCount = columnCount;
        this.params = params;
        selectedIDs = new ArrayList<>();
        WindowManager wm = (WindowManager) activity.getSystemService(Context.WINDOW_SERVICE);
        Display display = wm.getDefaultDisplay();
        Point size = new Point();
        display.getSize(size);
        screenWidth = size.x;

    }

    @Override
    public int getItemCount() {
        return list.size();
    }

    @Override
    public long getItemId(int position) {
        return list.get(position)._id;
    }

    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater mInflater = (LayoutInflater) activity.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = mInflater.inflate(R.layout.image_item, parent, false);
        ImageHolder dataObjectHolder = new ImageHolder(view);
        return dataObjectHolder;
    }

    @Override
    public void onBindViewHolder(final RecyclerView.ViewHolder viewHolder, final int position) {
        final ImageHolder holder = (ImageHolder) viewHolder;
        final Image entity = list.get(position);
        float height;
        if (entity.isPortraitImage)
            height = Float.valueOf(activity.getResources().getDimension(R.dimen.image_height_landscape));
            // activity.getResources().getDimension(R.dimen.image_height_portrait);
            //240dp
        else
            height = Float.valueOf(activity.getResources().getDimension(R.dimen.image_height_portrait));
        if (holder.imageView != null) {
            Picasso.with(activity)
                    .load(entity.uri)
                    .placeholder(R.drawable.imagem_processada)
                    .error(R.drawable.imagem_indisponivel)
                    .resize(screenWidth / columnCount, (int) height)
                    .onlyScaleDown()
                    .centerInside()
                    .into(holder.imageView);
        }
       /* try {
            for (int i = 0; i < list.size(); i++) {
                Bitmap bit = CarregadorDeFoto.carrega(entity.imagePath);
                holder.imageView.setImageBitmap(bit);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }*/




       /* if (selectedIDs.contains(entity._id)) {
            if (params.getLightColor() != 0)
                holder.frameLayout.setForeground(new ColorDrawable(params.getLightColor()));
            holder.selectedImageView.setVisibility(View.VISIBLE);
        } else {
            holder.frameLayout.setForeground(null);
            holder.selectedImageView.setVisibility(View.GONE);
        }*/
        //  holder.setTag(R.id.image, entity._id);

        holder.parentLayout.setOnClickListener(onClickListener);
    }

    public void setSelectedItem(View parentView, long imageId) {
        if (selectedIDs.contains(imageId)) {
            selectedIDs.remove(Long.valueOf(imageId));
            ((FrameLayout) parentView.findViewById(R.id.frameLayout)).setForeground(null);
            ((ImageView) parentView.findViewById(R.id.selectedImageView)).setVisibility(View.GONE);
        } else {
            if (selectedIDs.size() < params.getPickerLimit()) {
                selectedIDs.add(Long.valueOf(imageId));
                if (params.getLightColor() != 0)
                    ((FrameLayout) parentView.findViewById(R.id.frameLayout)).setForeground(new ColorDrawable(params.getLightColor()));
                ((ImageView) parentView.findViewById(R.id.selectedImageView)).setVisibility(View.VISIBLE);
            } else {

            }
        }
    }

    /*
        public void scaleView(final View v, float startScale, float endScale, final boolean pad) {
            Animation anim = new ScaleAnimation(
                    startScale, endScale, // Start and end values for the X axis scaling
                    startScale, endScale, // Start and end values for the Y axis scaling
                    Animation.RELATIVE_TO_SELF, 0.5f, // Pivot point of X scaling
                    Animation.RELATIVE_TO_SELF, 0.5f); // Pivot point of Y scaling
            anim.setFillAfter(true); // Needed to keep the result of the animation
            anim.setDuration(200);
            v.startAnimation(anim);
        }
    */
    public void disableSelection() {
        selectedIDs.clear();
        notifyDataSetChanged();
    }

    public void setItems(ArrayList<Image> imagesList) {
        this.list.clear();
        this.list.addAll(imagesList);
    }

    public ArrayList<Long> getSelectedIDs() {
        return selectedIDs;
    }

    public void setOnHolderClickListener(View.OnClickListener onClickListener) {
        this.onClickListener = onClickListener;
    }

    public class ImageHolder extends RecyclerView.ViewHolder {
        public RelativeLayout parentLayout;
        public FrameLayout frameLayout;
        public AutoImageView imageView;
        public ImageView selectedImageView;

        public ImageHolder(View v) {
            super(v);
            imageView = (AutoImageView) v.findViewById(R.id.imageView);
            selectedImageView = (ImageView) v.findViewById(R.id.selectedImageView);
            parentLayout = (RelativeLayout) v.findViewById(R.id.parentLayout);
            frameLayout = (FrameLayout) v.findViewById(R.id.frameLayout);
            if (params.getToolbarColor() != 0)
                Utils.setViewBackgroundColor(activity, selectedImageView, params.getToolbarColor());
        }

        public void setId(int position) {
            parentLayout.setId(position);
        }

        public void setTag(int resource_id, long id) {
            parentLayout.setTag(resource_id, id);
        }
    }

}
