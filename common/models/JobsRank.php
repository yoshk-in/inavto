<?php

namespace common\models;

use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class JobsRank extends ActiveRecord
{
    public function behaviors()
    {
        parent::behaviors();
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'modified'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['modified'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
            // [

            //     'class' => \common\components\behaviors\CacheBehavior::className(),
            //     'cache_id' => ['CalculatorWidget', 'ScriptsWidget'],


            // ]
        ];
    }

    public static function tableName()
    {
        return 'jobs_rank';
    }

    // public function rules()
    // {
    //     return [
    //         [['job_id', 'ranking'], 'required', 'integer'],
    //         [['created', 'modified'], 'safe']
    //     ];
    // }
}
