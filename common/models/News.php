<?php
// @changed 8.02.2021
namespace common\models;

use common\helpers\traits\EscapeEmojiTrait;

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
            'title' => 'Title',
            'meta_title' => 'Meta Title',
            'alias' => 'Alias',
            'introtext' => 'Introtext',
            'body' => 'Body',
            'image' => 'Image',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'created' => 'Created',
            'modified' => 'Modified',
            'publish' => 'Опубликовано'
        ];
    }

    public static function getPublished($sortBy = 'modified', $limit = 4, $order = SORT_DESC)  
    {
        return self::find()->where(['publish' => '1'])->orderBy([$sortBy => $order])->limit($limit)->all();
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
