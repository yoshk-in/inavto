<?php
namespace common\models;

use yii\db\ActiveRecord;

class MainPage extends ActiveRecord
{
    public static function tableName()
    {
        return 'mainpage';
    }

    public function getBanners()
    {
        return $this->hasMany(Banners::class, ['banner_id' => 'id']);
    }
}

