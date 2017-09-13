<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/5/15
 * Time: 上午11:50
 */

namespace app\base\models;



use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }
}