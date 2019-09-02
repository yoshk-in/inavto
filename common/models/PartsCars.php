<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parts_cars".
 *
 * @property int $id
 * @property int $car_id
 * @property int $part_id
 *
 * @property Cars $car
 * @property Parts $part
 */
class PartsCars extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parts_cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'part_id'], 'integer'],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::className(), 'targetAttribute' => ['car_id' => 'id']],
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
            'car_id' => 'Car ID',
            'part_id' => 'Part ID',
        ];
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
    public function getPart()
    {
        return $this->hasOne(Parts::className(), ['id' => 'part_id']);
    }
}
