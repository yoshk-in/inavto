<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $model
 * @property int $generation_id
 * @property int $engine_id
 * @property int $year
 * @property string $email
 * @property string $phone
 * @property string $created
 * @property string $modified
 */
class Orders extends \yii\db\ActiveRecord
{
    public $works;
    public $detales;
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'modified'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['modified'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model', 'email', 'phone'], 'required'],
            [['generation_id', 'engine_id', 'year'], 'integer'],
            [['created', 'modified', 'works', 'sets'], 'safe'],
            [['model', 'email', 'phone'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Модель авто',
            'generation_id' => 'Поколение',
            'engine_id' => 'Двигатель',
            'year' => 'Пробег',
            'email' => 'Email',
            'phone' => 'Телефон',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'works' => 'Работы',
            'detales' => 'Запчасти'
        ];
    }
    
    public function getGeneration()
    {
        return $this->hasOne(Generations::className(), ['id' => 'generation_id']);
    }
    
    public function getEngine()
    {
        return $this->hasOne(Engines::className(), ['id' => 'engine_id']);
    }
    
    public function getJobs()
    {
        return $this->hasMany(Jobs::className(), ['id' => 'job_id'])->viaTable('orders_jobs', ['order_id' => 'id']);
    }
    
    public function getParts()
    {
        return $this->hasMany(Parts::className(), ['id' => 'part_id'])->viaTable('orders_parts', ['order_id' => 'id']);
    }
    
}
