<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jobcats_jobs".
 *
 * @property int $id
 * @property int $job_id
 * @property int $job_category_id
 *
 * @property JobsCategories $jobCategory
 * @property Jobs $job
 */
class JobcatsJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobcats_jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'job_category_id'], 'integer'],
            [['job_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobsCategories::className(), 'targetAttribute' => ['job_category_id' => 'id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::className(), 'targetAttribute' => ['job_id' => 'id']],
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
            'job_category_id' => 'Job Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobCategory()
    {
        return $this->hasOne(JobsCategories::className(), ['id' => 'job_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::className(), ['id' => 'job_id']);
    }
}
