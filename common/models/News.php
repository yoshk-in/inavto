<?php

namespace common\models;

use Yii;

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
            [['title', 'alias', 'introtext', 'body', 'created', 'modified'], 'required'],
            [['body', 'description', 'keywords'], 'string'],
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
        ];
    }
}
