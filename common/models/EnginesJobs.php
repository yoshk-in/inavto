<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "engines_jobs".
 *
 * @property int $id
 * @property int $job_id
 * @property int $engine_id
 *
 * @property Engines $engine
 * @property Jobs $job
 */
class EnginesJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'engines_jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'engine_id'], 'integer'],
            [['engine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engines::className(), 'targetAttribute' => ['engine_id' => 'id']],
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
            'engine_id' => 'Engine ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngine()
    {
        return $this->hasOne(Engines::className(), ['id' => 'engine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::className(), ['id' => 'job_id']);
    }
}
