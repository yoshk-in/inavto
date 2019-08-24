<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "years".
 *
 * @property int $id
 * @property string $title
 * @property int $mileage
 * @property string $created
 * @property string $modified
 *
 * @property YearsJobs[] $yearsJobs
 */
class Years extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'years';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created', 'modified'], 'required'],
            [['mileage'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'mileage' => 'Mileage',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearsJobs()
    {
        return $this->hasMany(YearsJobs::className(), ['year_id' => 'id']);
    }
}
