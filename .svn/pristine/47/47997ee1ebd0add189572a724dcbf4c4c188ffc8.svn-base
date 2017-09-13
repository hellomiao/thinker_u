<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/29
 * Time: 上午10:24
 */
namespace app\api\models;
use yii;
use yii\db\ActiveRecord;
class ApiModel extends  ActiveRecord
{
    public static $table = '';

    /**
     * Mar constructor.
     * @param array $table
     * @param array $config
     */
    public function __construct($table, $config = [])
    {
        self::$table = $table;
        parent::__construct($config);
    }

    /**
     * @return array|string
     */
    public static function tableName()
    {
        return self::$table;
    }

}