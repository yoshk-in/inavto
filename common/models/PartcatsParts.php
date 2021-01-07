<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partcats_parts".
 *
 * @property int $id
 * @property int $part_id
 * @property int $part_category_id
 *
 * @property PartsCategories $partCategory
 * @property Parts $part
 */
class PartcatsParts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partcats_parts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['part_id', 'part_category_id'], 'integer'],
            [['part_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartsCategories::className(), 'targetAttribute' => ['part_category_id' => 'id']],
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
            'part_category_id' => 'Part Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartCategory()
    {
        return $this->hasOne(PartsCategories::className(), ['id' => 'part_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPart()
    {
        return $this->hasOne(Parts::className(), ['id' => 'part_id']);
    }
}
