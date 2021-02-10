<?php
// @changed 8.02.2021
namespace backend\models;

use common\helpers\traits\EscapeEmojiTrait;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\helpers\Inflector;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $meta_title
 * @property string $alias
 * @property string $introtext
 * @property string $body
 * @property string $image
 * @property string $description
 * @property string $keywords
 * @property string $created
 * @property string $modified
 */
class News extends \yii\db\ActiveRecord
{
    // use EscapeEmojiTrait;
    

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
              //  'attribute' => 'title',
                'slugAttribute' => 'alias',
                'value' => function($event){
                    if(!empty($event->sender->alias))
                        return $event->sender->alias;
                    return Inflector::slug($event->sender->title);
                }
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body', 'description', 'keywords'], 'string'],
            [['publish'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['title', 'meta_title', 'alias', 'introtext', 'image'], 'string', 'max' => 255],
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
            'meta_title' => 'Мета-заголовок',
            'alias' => 'Alias',
            'introtext' => 'превью',
            'body' => 'Текст',
            'image' => 'Image',
            'description' => 'Мета-описание',
            'keywords' => 'Ключевые слова',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'publish' => 'Опубликовано'
        ];
    }
    
    // public function escapingAttributes()
    // {
    //     return [
    //         'title',
    //         'meta_title',
    //         'description'
    //     ];
    // }

}
