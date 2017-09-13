<?php

namespace app\admin\models;

use Yii;

/**
 * This is the model class for table "{{%attachments}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $input_name
 * @property string $path
 * @property string $ext
 * @property integer $size
 * @property string $remark
 * @property integer $create_at
 */
class Attachments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attachments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'size', 'create_at'], 'integer'],
            [['name', 'path'], 'string', 'max' => 200],
            [['input_name'], 'string', 'max' => 20],
            [['ext'], 'string', 'max' => 255],
            [['remark'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '上传人',
            'name' => '名称',
            'input_name' => 'Input Name',
            'path' => '路径',
            'ext' => '扩张类型',
            'size' => 'Size',
            'remark' => '备注说明',
            'create_at' => '上传时间',
        ];
    }

    public function getPreview()
    {
        $path=$this->path;
        $ext=$this->ext;
        $assetUrl = \Yii::$app->assetManager->getPublishedUrl('@app/admin/misc');
        $url = \Yii::getAlias('@web/static/docs') .'/'. $path;
        $path = \Yii::getAlias('@webroot/static/docs') . DIRECTORY_SEPARATOR . $path;

        if (in_array($ext, ['xls', 'xlsx'])) {

            $preview = $assetUrl . '/images/excel.png';
        } elseif (in_array($ext, ['doc', 'docx'])) {

            $preview = $assetUrl . '/images/word.png';
        } elseif (in_array($ext, ['jpg', 'png','jpeg'])) {
            $preview = $url;
        } elseif (in_array($ext, ['zip'])) {
            $preview = $assetUrl . '/images/zip.png';
        } elseif (in_array($ext, ['rar'])) {
            $preview = $assetUrl . '/images/rar.png';
        } elseif (in_array($ext, ['txt'])) {
            $preview = $assetUrl . '/images/txt.png';
        } else {
            $preview = $assetUrl . '/images/other.png';

        }

        return $preview;
    }

    public function getPath()
    {
        $path = \Yii::getAlias('@web/static/docs') . '/' . $this->path;
        $url = Url::to(['/project/attachments/download', 'url' => $path]);
        return $url;
    }
}
