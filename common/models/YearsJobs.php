<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "years_jobs".
 *
 * @property int $id
 * @property int $job_id
 * @property int $year_id
 *
 * @property Jobs $job
 * @property Years $year
 */
class YearsJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'years_jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'year_id'], 'integer'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['year_id'], 'exist', 'skipOnError' => true, 'targetClass' => Years::className(), 'targetAttribute' => ['year_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'year_id' => 'Year ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::className(), ['id' => 'job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Years::className(), ['id' => 'year_id']);
    }
}
