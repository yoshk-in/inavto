<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parts_jobs".
 *
 * @property int $id
 * @property int $job_id
 * @property int $part_id
 *
 * @property Jobs $job
 * @property Parts $part
 */
class PartsJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parts_jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'part_id'], 'integer'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['part_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parts::className(), 'targetAttribute' => ['part_id' => 'id']],
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
            'part_id' => 'Part ID',
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
    public function getPart()
    {
        return $this->hasOne(Parts::className(), ['id' => 'part_id']);
    }
}
