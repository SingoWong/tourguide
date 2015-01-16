package com.heiscloud.heiscloudapp;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;

import android.net.Uri;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.content.Intent;
import android.provider.MediaStore;
import android.graphics.Bitmap;

public class MainActivity extends ActionBarActivity {

    public static final int FILECHOOSER_RESULTCODE = 0;
    WebView webView;
    ValueCallback<Uri> mUploadMessage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        webView = (WebView)findViewById(R.id.webView);
        webView.setScrollBarStyle(View.SCROLLBARS_INSIDE_OVERLAY);
//        webView.setWebViewClient(new CustomWebViewClient());
        webView.getSettings().setJavaScriptEnabled(true);
        webView.loadUrl("http://www.heiscloud.com/");

        webView.setWebChromeClient(new WebChromeClient(){

            public void openFileChooser(ValueCallback<Uri> uploadMsg,
                                        String acceptType, String capture) {
                mUploadMessage = uploadMsg;
	            /*
	            Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
	            intent.addCategory(Intent.CATEGORY_OPENABLE);
	            intent.setType("image/*");
//	            startActivityForResult(Intent.createChooser(intent, "完成操作需要使用"),MainActivity.FILECHOOSER_RESULTCODE);
	            startActivityForResult(intent,MainActivity.FILECHOOSER_RESULTCODE);
	             */
                Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                startActivityForResult(intent, MainActivity.FILECHOOSER_RESULTCODE);
            }

            // 3.0 + 调用这个方法
            public void openFileChooser(ValueCallback<Uri> uploadMsg,
                                        String acceptType) {
                mUploadMessage = uploadMsg;
	            /*
	            Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
	            intent.addCategory(Intent.CATEGORY_OPENABLE);
	            intent.setType("image/*");
	            startActivityForResult(intent,MainActivity.FILECHOOSER_RESULTCODE);
	            */
                Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                startActivityForResult(intent, MainActivity.FILECHOOSER_RESULTCODE);
            }

            // Android < 3.0 调用这个方法
            public void openFileChooser(ValueCallback<Uri> uploadMsg) {
                mUploadMessage = uploadMsg;
	            /*
	            Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
	            intent.addCategory(Intent.CATEGORY_OPENABLE);
	            intent.setType("image/*");
	            startActivityForResult(intent,MainActivity.FILECHOOSER_RESULTCODE);
	             */
                Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                startActivityForResult(intent, MainActivity.FILECHOOSER_RESULTCODE);
            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == FILECHOOSER_RESULTCODE) {
            if (null == mUploadMessage) return;
//	        Uri result = intent == null || resultCode != RESULT_OK ? null : intent.getData();
//	        mUploadMessage.onReceiveValue(result);
//	        mUploadMessage = null;


            SimpleDateFormat sdf = new SimpleDateFormat("yyyyMMddHHmmss");

            Bundle bundle = data.getExtras();
            Bitmap bitmap = (Bitmap) bundle.get("data");

            File toFile = FileUtils.getPrivateFile(getApplicationContext(), "topic", sdf.format(new Date(System.currentTimeMillis())) + ".jpg", false, false);
            FileOutputStream fos = null;
            try {
                fos = new FileOutputStream(toFile);
                bitmap.compress(Bitmap.CompressFormat.JPEG, 70, fos);
                fos.flush();
                mUploadMessage.onReceiveValue(Uri.fromFile(toFile));
                mUploadMessage = null;
            } catch (Exception e) {
                e.printStackTrace();
            } finally {
                try {
                    if(fos != null) fos.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }

        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
