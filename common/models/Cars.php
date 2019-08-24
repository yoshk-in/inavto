<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "cars".
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property string $created
 * @property string $modified
 *
 * @property Generations[] $generations
 * @property JobsCategories[] $jobsCategories
 * @property Parts[] $parts
 * @property PartsCategories[] $partsCategories
 */
class Cars extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
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
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created', 'modified'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'img' => 'Изображение',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenerations()
    {
        return $this->hasMany(Generations::className(), ['car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobsCategories()
    {
        return $this->hasMany(JobsCategories::className(), ['car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasMany(Parts::className(), ['car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartsCategories()
    {
        return $this->hasMany(PartsCategories::className(), ['car_id' => 'id']);
    }
}
