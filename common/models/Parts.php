<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parts".
 *
 * @property int $id
 * @property string $title
 * @property int $pc_id
 * @property int $car_id
 * @property int $engine_id
 * @property int $generation_id
 * @property int $brand_id
 * @property int $job_id
 * @property string $price
 * @property int $check
 * @property int $original
 * @property string $code
 * @property string $created
 * @property string $modified
 *
 * @property Brands $brand
 * @property Cars $car
 * @property Engines $engine
 * @property Generations $generation
 * @property Jobs $job
 * @property PartsCategories $pc
 */
class Parts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code', 'created', 'modified'], 'required'],
            [['pc_id', 'car_id', 'engine_id', 'generation_id', 'brand_id', 'job_id', 'check', 'original'], 'integer'],
            [['price'], 'number'],
            [['created', 'modified'], 'safe'],
            [['title', 'code'], 'string', 'max' => 255],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['engine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engines::className(), 'targetAttribute' => ['engine_id' => 'id']],
            [['generation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generations::className(), 'targetAttribute' => ['generation_id' => 'id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['pc_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartsCategories::className(), 'targetAttribute' => ['pc_id' => 'id']],
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
            'pc_id' => 'Pc ID',
            'car_id' => 'Car ID',
            'engine_id' => 'Engine ID',
            'generation_id' => 'Generation ID',
            'brand_id' => 'Brand ID',
            'job_id' => 'Job ID',
            'price' => 'Price',
            'check' => 'Check',
            'original' => 'Original',
            'code' => 'Code',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Cars::className(), ['id' => 'car_id']);
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
    public function getGeneration()
    {
        return $this->hasOne(Generations::className(), ['id' => 'generation_id']);
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
    public function getPc()
    {
        return $this->hasOne(PartsCategories::className(), ['id' => 'pc_id']);
    }
}
