<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property string $title
 * @property int $jc_id
 * @property string $price
 * @property int $recomended
 * @property string $created
 * @property string $modified
 *
 * @property JobsCategories $jc
 * @property Parts[] $parts
 * @property YearsJobs[] $yearsJobs
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created', 'modified'], 'required'],
            [['jc_id', 'recomended'], 'integer'],
            [['price'], 'number'],
            [['created', 'modified'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['jc_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobsCategories::className(), 'targetAttribute' => ['jc_id' => 'id']],
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
            'jc_id' => 'Jc ID',
            'price' => 'Price',
            'recomended' => 'Recomended',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJc()
    {
        return $this->hasOne(JobsCategories::className(), ['id' => 'jc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasMany(Parts::className(), ['job_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearsJobs()
    {
        return $this->hasMany(YearsJobs::className(), ['job_id' => 'id']);
    }
}
