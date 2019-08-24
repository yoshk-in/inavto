<?php

namespace common\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'meta_title', 'alias', 'introtext', 'body', 'image', 'description', 'keywords', 'created', 'modified'], 'required'],
            [['body', 'description', 'keywords'], 'string'],
            [['main'], 'integer'],
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
            'main' => 'Main',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
