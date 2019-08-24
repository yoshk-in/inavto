<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parts_categories".
 *
 * @property int $id
 * @property string $title
 * @property string $meta_title
 * @property string $alias
 * @property string $body
 * @property int $parent
 * @property string $description
 * @property string $keywords
 * @property string $created
 * @property string $modified
 * @property int $car_id
 *
 * @property Parts[] $parts
 * @property Cars $car
 */
class PartsCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parts_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'meta_title', 'alias', 'body', 'description', 'keywords', 'created', 'modified', 'car_id'], 'required'],
            [['body', 'description', 'keywords'], 'string'],
            [['parent', 'car_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['title', 'meta_title', 'alias'], 'string', 'max' => 255],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::className(), 'targetAttribute' => ['car_id' => 'id']],
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
            'meta_title' => 'Meta Title',
            'alias' => 'Alias',
            'body' => 'Body',
            'parent' => 'Parent',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'created' => 'Created',
            'modified' => 'Modified',
            'car_id' => 'Car ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasMany(Parts::className(), ['pc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Cars::className(), ['id' => 'car_id']);
    }
}
