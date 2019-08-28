<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "jobs_categories".
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $meta_title
 * @property string $body
 * @property int $parent
 * @property int $service
 * @property string $description
 * @property string $keywords
 * @property string $created
 * @property string $modified
 * @property int $car_id
 *
 * @property Jobs[] $jobs
 * @property Cars $car
 */
class JobsCategories extends \yii\db\ActiveRecord
{
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'menu_title',
                'slugAttribute' => 'alias',
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'car_id'], 'required'],
            [['body', 'description', 'keywords'], 'string'],
            [['parent', 'service', 'car_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['title', 'alias', 'meta_title', 'menu_title'], 'string', 'max' => 255],
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
            'title' => 'Название',
            'alias' => 'Alias',
            'meta_title' => 'Мета-заголовок',
            'menu_title' => 'Короткое название',
            'body' => 'Текст',
            'parent' => 'Родительская категория',
            'service' => 'Обслуживание',
            'description' => 'Мета-описание',
            'keywords' => 'Ключевые слова',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'car_id' => 'Автомобиль',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Jobs::className(), ['jc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Cars::className(), ['id' => 'car_id']);
    }
}
