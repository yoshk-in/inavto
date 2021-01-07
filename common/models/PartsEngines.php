<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parts_engines".
 *
 * @property int $id
 * @property int $part_id
 * @property int $engine_id
 *
 * @property Engines $engine
 * @property Parts $part
 */
class PartsEngines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parts_engines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['part_id', 'engine_id'], 'integer'],
            [['engine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engines::className(), 'targetAttribute' => ['engine_id' => 'id']],
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
            'part_id' => 'Part ID',
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
    public function getPart()
    {
        return $this->hasOne(Parts::className(), ['id' => 'part_id']);
    }
}
