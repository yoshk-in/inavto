<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string $title
 * @property string $slogan_one
 * @property string $slogan_two
 * @property string $link
 * @property string $img
 * @property string $img_thumb
 * @property int $sort
 * @property string $created
 * @property string $modified
 *
 * @property BannersPages[] $bannersPages
 */
class Banners extends \yii\db\ActiveRecord
{
    public $image;
    public $crop_info;
    
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
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['sort'], 'integer'],
            [
                'image', 
                'image', 
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            ['crop_info', 'safe'],
            [['created', 'modified'], 'safe'],
            [['title', 'slogan_one', 'slogan_two', 'link', 'img', 'img_thumb'], 'string', 'max' => 255],
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
            'slogan_one' => 'Слоган 1',
            'slogan_two' => 'Слоган 2',
            'link' => 'Ссылка',
            'img' => 'Изображение',
            'img_thumb' => 'Превью',
            'sort' => 'Сортировка',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['id' => 'page_id'])->viaTable('banners_pages', ['banner_id' => 'id']);
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        // open image
        $image = Image::getImagine()->open($this->image->tempName);

        // rendering information about crop of ONE option 
        $cropInfo = Json::decode($this->crop_info)[0];
        $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
        $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
        $cropInfo['x'] = $cropInfo['x']; //begin position of frame crop by X
        $cropInfo['y'] = $cropInfo['y']; //begin position of frame crop by Y
        // Properties bolow we don't use in this example
        //$cropInfo['ratio'] = $cropInfo['ratio'] == 0 ? 1.0 : (float)$cropInfo['ratio']; //ratio image. 
        //$cropInfo['width'] = (int)$cropInfo['width']; //width of cropped image
        //$cropInfo['height'] = (int)$cropInfo['height']; //height of cropped image
        //$cropInfo['sWidth'] = (int)$cropInfo['sWidth']; //width of source image
        //$cropInfo['sHeight'] = (int)$cropInfo['sHeight']; //height of source image

        //delete old images
        $oldImages = FileHelper::findFiles(Yii::getAlias('@path/to/save/image'), [
            'only' => [
                $this->id . '.*',
                'thumb_' . $this->id . '.*',
            ], 
        ]);
        for ($i = 0; $i != count($oldImages); $i++) {
            @unlink($oldImages[$i]);
        }

        //saving thumbnail
        $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
        $cropSizeThumb = new Box(200, 200); //frame size of crop
        $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
        $pathThumbImage = Yii::getAlias('@path/to/save/image') 
            . '/thumb_' 
            . $this->id 
            . '.' 
            . $this->image->getExtension();  

        $image->resize($newSizeThumb)
            ->crop($cropPointThumb, $cropSizeThumb)
            ->save($pathThumbImage, ['quality' => 100]);

        //saving original
        $this->image->saveAs(
            Yii::getAlias('@path/to/save/image') 
            . '/' 
            . $this->id 
            . '.' 
            . $this->image->getExtension()
        );
    }
}
