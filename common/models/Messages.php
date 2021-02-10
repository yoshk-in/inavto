<?php // @changed 8.02.2021

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\helpers\Format;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $phone
 * @property int $service_id
 * @property string $email
 * @property string $avto
 * @property string $message
 * @property string $created
 * @property string $modified
 *
 * @property Services $service
 */
class Messages extends \yii\db\ActiveRecord implements Format
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
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['service_id', 'flag'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['email'], 'email'],
            [['phone'], 'match', 'pattern' => self::PHONE_PATTERN],
            [['avto'], 'string', 'max' => 100],
            [['message'], 'string', 'max' => 255],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Телефон',
            'service_id' => 'Сервисная станция',
            'email' => 'Email',
            'avto' => 'Автомобиль',
            'message' => 'Сообщение',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'flag' => 'Флаг'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        $mail = 'master@inavtospb.ru';
        
        if($this->flag && $this->flag == 1){
            if($this->service_id && $this->service_id == 1){
                $mail = 'parts-inavto@yandex.ru';
            }else{
                $mail = 'inavtoplus@yandex.ru';
            }
        }
        
        if($this->flag && $this->flag == 2){
            if($this->service_id && $this->service_id == 1){
                $mail = 'master@inavtospb.ru';
            }else{
                $mail = 'ekat5@inavtospb.ru';
            }
        }
        
        Yii::$app->mailer->compose('send', ['author' => 'Заявка:', 'body' => ['phone' => $this->phone, 'text' => $this->message, 'email' => $this->email, 'avto' => $this->avto], 'mail' => 'newsite@inavtospb.ru', 'file' => ''])
            ->setFrom(['newsite@inavtospb.ru' => 'Сообщение с сайта inavtospb.ru'])
            ->setTo($mail)
            ->setSubject('Заявка')
            ->send();
        
        parent::afterSave($insert, $changedAttributes);
    }
}
