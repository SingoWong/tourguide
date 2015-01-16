package com.heiscloud.heiscloudapp;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;

import android.content.Context;
import android.content.res.AssetManager;
import android.os.Environment;
import android.os.StatFs;

public class FileUtils {

    public static enum MEMORY_TYPE {
        INTERNAL_CACHE,
        INTERNAL_FILES,
        EXTERNAL_CACHE,
        EXTERNAL_FILES,
        //		SDCARD_APP_ROOT = 5;
        SDCARD_ROOT
    }


    /**
     * 判断sdcard是否可用
     * @return
     */
    public static boolean externalMemoryAvailable() {
        return Environment.getExternalStorageState().equals(Environment.MEDIA_MOUNTED);
    }

    /**
     * 获取内存储可用空间
     * @return
     */
    public static long getAvailableInternalMemorySize() {
        File path = Environment.getDataDirectory();
        StatFs stat = new StatFs(path.getPath());
        long blockSize = stat.getBlockSize();
        long availableBlocks = stat.getAvailableBlocks();
        return availableBlocks * blockSize;
    }

    /**
     * 获取内存储全部空间
     * @return
     */
    public static long getTotalInternalMemorySize() {
        File path = Environment.getDataDirectory();
        StatFs stat = new StatFs(path.getPath());
        long blockSize = stat.getBlockSize();
        long totalBlocks = stat.getBlockCount();
        return totalBlocks * blockSize;
    }

    /**
     * 获取外存储可用空间
     * @return
     */
    public static long getAvailableExternalMemorySize() {
        if(externalMemoryAvailable()) {
            File path = Environment.getExternalStorageDirectory();
            StatFs stat = new StatFs(path.getPath());
            long blockSize = stat.getBlockSize();
            long availableBlocks = stat.getAvailableBlocks();
            return availableBlocks * blockSize;
        } else {
            return -1;
        }
    }

    /**
     * 获取外存储全部空间
     * @return
     */
    public static long getTotalExternalMemorySize() {
        if(externalMemoryAvailable()) {
            File path = Environment.getExternalStorageDirectory();
            StatFs stat = new StatFs(path.getPath());
            long blockSize = stat.getBlockSize();
            long totalBlocks = stat.getBlockCount();
            return totalBlocks * blockSize;
        } else {
            return -1;
        }
    }

    //----------------------------------------------------------------------------------------------

    /**
     * 私有方法，根据参数创建文件
     * @param context
     * @param subDir  子目录
     * @param fileName   文件名
     * @param memoryType   存储空间类型
     * @return
     */
    private static File newFile(Context context, String subDir, String fileName, MEMORY_TYPE memoryType){
        File file = null;
        String rootPath = "";
        boolean isCustom = false;

        if(memoryType == MEMORY_TYPE.INTERNAL_CACHE){
            rootPath = context.getCacheDir().getAbsolutePath();
        }else if(memoryType == MEMORY_TYPE.INTERNAL_FILES){
            rootPath = context.getFilesDir().getAbsolutePath();
        }else if(externalMemoryAvailable() && memoryType == MEMORY_TYPE.EXTERNAL_CACHE){
            rootPath = context.getExternalCacheDir().getAbsolutePath();
        }else if(externalMemoryAvailable() && memoryType == MEMORY_TYPE.EXTERNAL_FILES){
            rootPath = context.getExternalFilesDir(null).getAbsolutePath();
        }
//		else if(externalMemoryAvailable() && memoryType == MEMORY_SDCARD_MAGIC_WALL_ROOT){//sdcard
//			rootPath = Environment.getExternalStorageDirectory().getAbsolutePath() + "/" + SDCARD_MAGIC_WALL_ROOT_DIR;
//			File root = new File(rootPath);
//			if(!root.exists()) root.mkdir();
//		}
        else if(externalMemoryAvailable() && memoryType == MEMORY_TYPE.SDCARD_ROOT){//sdcard
            isCustom = true;
        }
        File root = new File(rootPath);
        if(!root.exists()) root.mkdirs();

        if(!rootPath.equals("") || isCustom){
            if(subDir != null && !subDir.trim().equals("")){
                File dir = new File(rootPath + "/" + subDir);
                if(!dir.exists()) dir.mkdirs();
                file = new File(dir.getAbsoluteFile() + "/" + fileName);
            }else {
                file = new File(rootPath + "/" + fileName);
            }
        }
        return file;
    }

    /**
     * 获取应用私有文件
     * @param context
     * @param subDir 子目录
     * @param fileName 文件名
     * @param isCache 是否缓存文件
     * @param onlyInternal 是否只在系统内存储获取（不考虑SDCard）
     * @return
     */
    public static File getPrivateFile(Context context, String subDir, String fileName, boolean isCache, boolean onlyInternal){
        File file = null;
        if(isCache){
            if(externalMemoryAvailable() && !onlyInternal) {
                file = newFile(context, subDir, fileName, MEMORY_TYPE.EXTERNAL_CACHE);
            }else {
                file = newFile(context, subDir, fileName, MEMORY_TYPE.INTERNAL_CACHE);
            }
        }else {
            if(externalMemoryAvailable() && !onlyInternal) {
                file = newFile(context, subDir, fileName, MEMORY_TYPE.EXTERNAL_FILES);
            }else {
                file = newFile(context, subDir, fileName, MEMORY_TYPE.INTERNAL_FILES);
            }
        }
        return file;
    }

    /**
     * 获取sdcrad上的文件
     * @param context
     * @param subDir  子目录
     * @param fileName 文件名
     * @return
     */
    public static File getPublicFile(Context context, String subDir, String fileName){
        File file = null;
        if(externalMemoryAvailable()) {
            file = newFile(context, subDir, fileName, MEMORY_TYPE.SDCARD_ROOT);
        }
        return file;
    }

    /**
     * 将内容写入文件
     * @param file 要写入的对象文件
     * @param is 内容流
     */
    public static void writeToFile(File file, InputStream is){
        FileOutputStream fos = null;
        try {
            fos = new FileOutputStream(file);
            byte[] buff=new byte[1024 * 10];
            int len=-1;
            while((len=is.read(buff)) != -1){
                fos.write(buff, 0, len);
            }
            fos.flush();
        } catch (Exception e) {
            e.printStackTrace();
            throw new RuntimeException(e.getMessage());
        }finally{
            try {
                if(is != null) is.close();
                if(fos != null) fos.close();
            } catch (IOException e) {
                throw new RuntimeException(e.getMessage());
            }
        }
    }

    public static String readStringFromFile(File file){
        StringBuffer sb = new StringBuffer();
        BufferedReader ir = null;
        try {
            ir = new BufferedReader(new InputStreamReader(new FileInputStream(file)));
            String line = "";
            while ((line = ir.readLine()) != null){
                sb.append(line);
            }
        } catch (Exception e) {
//			e.printStackTrace();
            throw new RuntimeException(e.getMessage());
        }finally{
            try {
                if(ir != null) ir.close();
            } catch (IOException e) {
                throw new RuntimeException(e.getMessage());
            }
        }
        return sb.toString();
    }

    /**
     * 在制定目录中判断文件是否存在,如果存在，返回该文件
     * @param context
     * @param subDir  子目录
     * @param fileName 文件名
     * @param fileFlags 文件目录标志
     * @return
     */
    public static File fileIsExist(Context context, String subDir, String fileName, MEMORY_TYPE... fileFlags){
        File file = null;
        if(fileFlags != null && fileFlags.length > 0){
            for(MEMORY_TYPE fileFlag : fileFlags){
                file = newFile(context, subDir, fileName, fileFlag);
                if(file != null && file.exists()) return file;
            }
        }
        return file;
    }

    /**
     * 从Asset目录读取文件
     * @param context
     * @param fileName
     * @return
     */
    public static InputStream loadFileFromAsset(Context context, String fileName){
        InputStream is = null;
        AssetManager am = context.getResources().getAssets();
        try {
            is = am.open(fileName);
        } catch (IOException e) {
//			e.printStackTrace();
        }
        return is;
    }
}