<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\Generations;

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
    public $generations;
    public $engines;
    
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
        return 'parts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['pc_id', 'car_id', 'engine_id', 'brand_id', 'job_id', 'check', 'original'], 'integer'],
            [['price'], 'number'],
            [['created', 'modified', 'generations', 'engines'], 'safe'],
            [['title', 'code'], 'string', 'max' => 255],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::className(), 'targetAttribute' => ['car_id' => 'id']],
          //  [['engine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engines::className(), 'targetAttribute' => ['engine_id' => 'id']],
       //     [['generation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generations::className(), 'targetAttribute' => ['generation_id' => 'id']],
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
            'title' => 'Название',
            'pc_id' => 'Категория',
            'car_id' => 'Авто',
           // 'engine_id' => 'Двигатель',
           // 'generation_id' => 'Поколение авто',
            'brand_id' => 'Бренд',
            'job_id' => 'Работа',
            'price' => 'Цена',
            'check' => 'В наличии',
            'original' => 'Оригинал',
            'code' => 'Артикул',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'generations' => 'Поколения авто',
            'engines' => 'Двигатели'
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
    /*public function getEngine()
    {
        return $this->hasOne(Engines::className(), ['id' => 'engine_id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getGeneration()
    {
        return $this->hasOne(Generations::className(), ['id' => 'generation_id']);
    }*/

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
    
    public function getGeneration()
    {
        return $this->hasMany(Generations::className(), ['id' => 'generation_id'])->viaTable('parts_generations', ['part_id' => 'id']);
    }
    
    public function getEngine()
    {
        return $this->hasMany(Engines::className(), ['id' => 'engine_id'])->viaTable('parts_engines', ['part_id' => 'id']);
    }
    
    public function afterSave($insert, $changedAttributes)
    {
       $this->unlinkAll('generation', true);
       if($this->generations && !empty($this->generations))
        foreach($this->generations as $value){
            $item = Generations::findOne($value);
            $this->link('generation', $item);
        }
        
        $this->unlinkAll('engine', true);
       if($this->engines && !empty($this->engines))
        foreach($this->engines as $value){
            $item = Engines::findOne($value);
            $this->link('engine', $item);
        }
        
        parent::afterSave($insert, $changedAttributes);
    }
}
