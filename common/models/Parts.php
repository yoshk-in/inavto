<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\Generations;
use common\models\PartsCategories;
use common\models\Cars;
use common\models\Jobs;

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
    public $works;
    public $cars;
    public $categories;
    
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
            [['created', 'modified', 'generations', 'engines', 'works', 'cars', 'categories'], 'safe'],
            [['title', 'code', 'oem'], 'string', 'max' => 255],
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
         //   'pc_id' => 'Категория',
            'categories' => 'Список категорий',
           // 'car_id' => 'Авто',
           // 'engine_id' => 'Двигатель',
           // 'generation_id' => 'Поколение авто',
            'brand_id' => 'Бренд',
            'job_id' => 'Работа',
            'price' => 'Цена',
            'check' => 'В наличии',
            'original' => 'Оригинал',
            'code' => 'Артикул',
            'oem' => 'OEM',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'generations' => 'Поколения авто',
            'engines' => 'Двигатели',
            'works' => 'Список работ',
            'cars' => 'Автомобили',
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
    public function getJobs()
    {
        return $this->hasMany(Jobs::className(), ['id' => 'job_id'])->viaTable('parts_jobs', ['part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   
    public function getCats()
    {
        return $this->hasMany(PartsCategories::className(), ['id' => 'part_category_id'])->viaTable('partcats_parts', ['part_id' => 'id']);
    }
    
    public function getAvtos()
    {
        return $this->hasMany(Cars::className(), ['id' => 'car_id'])->viaTable('parts_cars', ['part_id' => 'id']);
    }
    
    public function getGeneration()
    {
        return $this->hasMany(Generations::className(), ['id' => 'generation_id'])->viaTable('parts_generations', ['part_id' => 'id']);
    }
    
    public function getEngine()
    {
        return $this->hasMany(Engines::className(), ['id' => 'engine_id'])->viaTable('parts_engines', ['part_id' => 'id']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->original = !empty($this->original)  ? $this->original : null;
            return true;
        }
        return false;
    }
    
    public function afterSave($insert, $changedAttributes)
    {
       if($this->generations && !empty($this->generations)){
           $this->unlinkAll('generation', true);
           foreach($this->generations as $value){
                $item = Generations::findOne($value);
                $this->link('generation', $item);
            }
       }
        
        
       if($this->engines && !empty($this->engines)){
           $this->unlinkAll('engine', true);
           foreach($this->engines as $value){
                $item = Engines::findOne($value);
                $this->link('engine', $item);
            }
       }
        
        
        if($this->categories && !empty($this->categories)){
            $cats = $this->categories;
            $this->unlinkAll('cats', true);
            foreach($cats as $key => $value){
                $item = PartsCategories::findOne($value);
                $this->link('cats', $item);
            }
        }
        
        
        if($this->cars && !empty($this->cars)){
            $this->unlinkAll('avtos', true);
            foreach($this->cars as $value){
                $item = Cars::findOne($value);
                $this->link('avtos', $item);
            }
        }
        
        
        if($this->works && !empty($this->works)){
            $this->unlinkAll('jobs', true);
            foreach($this->works as $value){
                $item = Jobs::findOne($value);
                $this->link('jobs', $item);
            }
        }
        
        parent::afterSave($insert, $changedAttributes);
    }
}
