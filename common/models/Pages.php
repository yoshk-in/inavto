<?php

namespace common\models;
// @changed 8.02.2021
use common\helpers\traits\DoubleTableModel;
use common\helpers\traits\EscapeEmojiTrait;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pages".
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
 * @property int $main
 * @property string $created
 * @property string $modified
 */
class Pages extends \yii\db\ActiveRecord
{
    use DoubleTableModel;
    // use EscapeEmojiTrait;
    const DESKTOP = 'pages';
    const MOBILE = 'pages_mobile';
    const TABLE_NAME_PROP = 'tableName';
    public static $tableName = 'pages';


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
            ]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body', 'description', 'keywords'], 'string'],
            [['main', 'menu'], 'integer'],
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
            'introtext' => 'Превью',
            'body' => 'Текст',
            'image' => 'Изображение',
            'description' => 'Мета-описание',
            'keywords' => 'Ключевые слова',
            'main' => 'Главная',
            'menu' => 'Показывать в меню',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
        ];
    }
    
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['id' => 'banner_id'])->viaTable('banners_pages', ['page_id' => 'id']);
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
