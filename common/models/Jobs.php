<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\Engines;
use common\models\Years;

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
    public $engines;
    public $years;
    
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
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['jc_id', 'recomended'], 'integer'],
            [['price'], 'number'],
            [['created', 'modified', 'engines', 'years'], 'safe'],
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
            'title' => 'Название',
            'jc_id' => 'Категория',
            'price' => 'Цена',
            'recomended' => 'Рекомендованная работа',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'engines' => 'Выбрать поколение и двигатель',
            'years' => 'Срок эксплуотации авто'
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

    public function getMotors()
    {
        return $this->hasMany(Engines::className(), ['id' => 'engine_id'])->viaTable('engines_jobs', ['job_id' => 'id']);
    }
    
    public function getPeriods()
    {
        return $this->hasMany(Years::className(), ['id' => 'year_id'])->viaTable('years_jobs', ['job_id' => 'id']);
    }
    
    public function afterSave($insert, $changedAttributes)
    {
       $this->unlinkAll('periods', true);
       if($this->years && !empty($this->years))
        foreach($this->years as $value){
            $item = Years::findOne($value);
            $this->link('periods', $item);
        }
        
        $this->unlinkAll('motors', true);
        if($this->engines && !empty($this->engines))
        foreach($this->engines as $value){
            $item = Engines::findOne($value);
            $this->link('motors', $item);
        }
        
        parent::afterSave($insert, $changedAttributes);
    }
}
