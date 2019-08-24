<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "engines".
 *
 * @property int $id
 * @property string $title
 * @property string $alter_title
 * @property int $generation_id
 * @property string $created
 * @property string $modified
 *
 * @property Generations $generation
 * @property Parts[] $parts
 */
class Engines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'engines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'alter_title', 'created', 'modified'], 'required'],
            [['generation_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['title', 'alter_title'], 'string', 'max' => 50],
            [['generation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generations::className(), 'targetAttribute' => ['generation_id' => 'id']],
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
            'alter_title' => 'Alter Title',
            'generation_id' => 'Generation ID',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
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
    public function getParts()
    {
        return $this->hasMany(Parts::className(), ['engine_id' => 'id']);
    }
}
