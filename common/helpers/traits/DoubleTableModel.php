<?php
namespace common\helpers\traits;
// @changed 8.02.2021
use backend\models\Pages;

trait DoubleTableModel
{
    protected static $DESKTOP = 'pages';
    protected static $MOBILE = 'pages_mobile';
    protected static $TABLE_NAME_PROP = 'tableName';
    public static $tableName = 'pages';
    

    public static function tableName()
    {
        return self::$tableName;
    }



    public static function isMobile()
    {
        return self::$tableName == self::$MOBILE;
    }

    public static function isDesktop()
    {
        return self::$tableName == self::$DESKTOP;
    }

    public function load($data, $formName = null)
    {
        $key = self::$TABLE_NAME_PROP;
        if (isset($data[$key])) {
            self::$tableName = $data[$key];
            unset($data[$key]);
        }
        return parent::load($data, $formName);
    }

    public function updateOneTable()
    {
        return parent::save();
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $table = self::$tableName;
        self::$tableName = self::$DESKTOP;
        $attrs = $this->attributes;
        $res = parent::insert($runValidation, $attributeNames);
        self::$tableName = self::$MOBILE;
        // var_dump($attrs); exit;
        // var_dump($this->attributes); exit;
        $clone = (new Pages($attrs));
        unset($attrs['id'], $attrs['created'], $attrs['modified']);
        // var_dump($attrs);
        $clone->load($attrs);
        $res2 = $clone->insert($runValidation, $attributeNames);
        self::$tableName = $table;
        return $res && $res2;
    }

    public function delete()
    {
        $table = self::$tableName;
        self::$tableName = self::$DESKTOP;
        $res = parent::delete();
        self::$tableName = self::$MOBILE;
        $res2 = parent::delete();
        self::$tableName = $table;
        return $res && $res2;
    }
}

