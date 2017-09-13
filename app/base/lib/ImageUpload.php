<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/5/10
 * Time: 下午2:43
 */

namespace app\base\lib;


use yii\base\Object;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ImageUpload extends Object
{
    public $uploadDir;
    public $uploadUrl;
    /**
     * [UploadPhoto description]
     * @param [type]  $model      [实例化模型]
     * @param [type]  $path       [图片存储路径]
     * @param [type]  $originName [图片源名称]
     * @param boolean $isthumb    [是否要缩略图]
     */
    public function UploadPhoto($model,$originName){

        $ret =[];

        $folder=$this->getOwnerPath();
        $path = $this->getSaveDir().DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;
        //返回一个实例化对象
        $files = UploadedFile::getInstance($model,$originName);

        if(!$files){
            $ret['status']=true;
            return $ret;
        }

        if($model->validate()) {

            $pre = rand(999, 9999) . time();
            $newName = $pre . '.' . $files->getExtension();
            if ($files->size > 2000000) {
                $ret['status']=false;
                $ret['message']="上传的文件太大";
                return $ret;
            }
            if (!is_dir($path)) {
                if (!FileHelper::createDirectory($path, 0777, true)) {
                    $ret['status']=false;
                    $ret['message']='创建目录失败...' . $path;
                    return $ret;
                }
            }
            //echo $root.$folder.$newName;exit;
            if ($files->saveAs($path . $newName)) {

                $ret['status']=true;
                $ret['message']=$folder .'/'. $newName;;





            }

        }else{
            $ret['status']=false;
            $ret['message']=$model->getErrors($originName);


        }

        return $ret;
    }
    public function getOwnerPath()
    {
        return date("Ymd");
    }

    public function getSaveDir()
    {
        $path = \Yii::getAlias($this->uploadDir);
        if (!file_exists($path)) {
            throw new InvalidConfigException('Invalid config $uploadDir');
        }
        return $path;
    }


    public function getSaveUrl(){
        $url = \Yii::getAlias($this->uploadUrl);
        return $url;
    }


    public function myImageResize($src_file, $dst_file , $new_width , $new_height) {
        $new_width= intval($new_width);
        $new_height=intval($new_height);
        if($new_width <1 || $new_height <1) {
            echo "params width or height error !";
            exit();
        }
        if(!file_exists($src_file)) {
            echo $src_file . " is not exists !";
            exit();
        }
        // 图像类型
        $type=exif_imagetype($src_file);
        $support_type=array(IMAGETYPE_JPEG , IMAGETYPE_PNG , IMAGETYPE_GIF);
        if(!in_array($type, $support_type,true)) {
            echo "this type of image does not support! only support jpg , gif or png";
            exit();
        }
        //Load image
        switch($type) {
            case IMAGETYPE_JPEG :
                $src_img=imagecreatefromjpeg($src_file);
                break;
            case IMAGETYPE_PNG :
                $src_img=imagecreatefrompng($src_file);
                break;
            case IMAGETYPE_GIF :
                $src_img=imagecreatefromgif($src_file);
                break;
            default:
                echo "Load image error!";
                exit();
        }
        $w=imagesx($src_img);
        $h=imagesy($src_img);
        $ratio_w=1.0 * $new_width / $w;
        $ratio_h=1.0 * $new_height / $h;
        $ratio=1.0;
        // 生成的图像的高宽比原来的都小，或都大 ，原则是 取大比例放大，取大比例缩小（缩小的比例就比较小了）
        if( ($ratio_w < 1 && $ratio_h < 1) || ($ratio_w > 1 && $ratio_h > 1)) {
            if($ratio_w < $ratio_h) {
                $ratio = $ratio_h ; // 情况一，宽度的比例比高度方向的小，按照高度的比例标准来裁剪或放大
            }else {
                $ratio = $ratio_w ;
            }
            // 定义一个中间的临时图像，该图像的宽高比 正好满足目标要求
            $inter_w=(int)($new_width / $ratio);
            $inter_h=(int) ($new_height / $ratio);
            $inter_img=imagecreatetruecolor($inter_w , $inter_h);
            //var_dump($inter_img);
            imagecopy($inter_img, $src_img, 0,0,0,0,$inter_w,$inter_h);
            // 生成一个以最大边长度为大小的是目标图像$ratio比例的临时图像
            // 定义一个新的图像
            $new_img=imagecreatetruecolor($new_width,$new_height);
            //var_dump($new_img);exit();
            imagecopyresampled($new_img,$inter_img,0,0,0,0,$new_width,$new_height,$inter_w,$inter_h);
            switch($type) {
                case IMAGETYPE_JPEG :
                    imagejpeg($new_img, $dst_file,100); // 存储图像
                    break;
                case IMAGETYPE_PNG :
                    imagepng($new_img,$dst_file,9);
                    break;
                case IMAGETYPE_GIF :
                    imagegif($new_img,$dst_file,100);
                    break;
                default:
                    break;
            }
        } // end if 1
        // 2 目标图像 的一个边大于原图，一个边小于原图 ，先放大平普图像，然后裁剪
        // =if( ($ratio_w < 1 && $ratio_h > 1) || ($ratio_w >1 && $ratio_h <1) )
        else{
            $ratio=$ratio_h>$ratio_w? $ratio_h : $ratio_w; //取比例大的那个值
            // 定义一个中间的大图像，该图像的高或宽和目标图像相等，然后对原图放大
            $inter_w=(int)($w * $ratio);
            $inter_h=(int) ($h * $ratio);
            $inter_img=imagecreatetruecolor($inter_w , $inter_h);
            //将原图缩放比例后裁剪
            imagecopyresampled($inter_img,$src_img,0,0,0,0,$inter_w,$inter_h,$w,$h);
            // 定义一个新的图像
            $new_img=imagecreatetruecolor($new_width,$new_height);
            imagecopy($new_img, $inter_img, 0,0,0,0,$new_width,$new_height);
            switch($type) {
                case IMAGETYPE_JPEG :
                    imagejpeg($new_img, $dst_file,100); // 存储图像
                    break;
                case IMAGETYPE_PNG :
                    imagepng($new_img,$dst_file,9);
                    break;
                case IMAGETYPE_GIF :
                    imagegif($new_img,$dst_file,100);
                    break;
                default:
                    break;
            }
        }// if3
    }// end function


}