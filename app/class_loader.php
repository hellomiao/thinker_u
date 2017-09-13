<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/21
 * Time: 下午3:17
 */
use creocoder\flysystem\LocalFilesystem;
class class_loader
{

    public static function registerPackageAlias()
    {


        $packageClassMaps = Yii::getAlias("@app/autoload_psr4.php");

        if (file_exists($packageClassMaps) == false) {
            $coreClassmaps = static::getCoreFile();

            foreach ($coreClassmaps as $namespace => $path) {
                \Yii::setAlias(rtrim(str_replace('\\', '/', $namespace), "/"), $path);
            }

            define("LOAD_PACKAGE", false);
            return;
        }

        $classMaps = require $packageClassMaps;
        static::registerAlias($classMaps);
        define("LOAD_PACKAGE", true);
    }
    public static function registerAlias($classMaps)
    {
        foreach ($classMaps as $namespace => $paths) {
            foreach ($paths as $path) {
                \Yii::setAlias(rtrim(str_replace('\\', '/', $namespace), "/"), $path);
            }
        }
    }
    public static function getCoreFile()
    {
        $filesystem = \Yii::createObject([
            "class" => LocalFilesystem::className(),
            "path" => __DIR__
        ]);
        $classMaps = [];
        foreach ($filesystem->listContents() as $item) {
            if ($item["type"] == "dir") {
                $path = $filesystem->getAdapter()->applyPathPrefix($item["path"]);
                $classMaps['app\\'.$item['path']] = $path;
            }
        }

        return $classMaps;
    }
}
class_loader::registerPackageAlias();