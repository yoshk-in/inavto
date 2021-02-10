<?php

namespace frontend\models;
// @changed 8.02.2021
use common\helpers\Format;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $model
 * @property int $generation_id
 * @property int $engine_id
 * @property int $year
 * @property string $email
 * @property string $phone
 * @property string $created
 * @property string $modified
 */
class Orders extends \yii\db\ActiveRecord implements Format
{
    public $works;
    public $sets;
    public $detales;

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
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['email'], 'email'],
            [['phone'], 'match', 'pattern' => self::PHONE_PATTERN],
            [['model'], 'required'],
            [['generation_id', 'engine_id', 'year'], 'integer'],
            [['created', 'modified', 'works', 'sets'], 'safe'],
            [['model', 'email', 'phone'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Модель авто',
            'generation_id' => 'Поколение',
            'engine_id' => 'Двигатель',
            'year' => 'Пробег',
            'email' => 'Email',
            'phone' => 'Телефон',
            'created' => 'Дата создания',
            'modified' => 'Дата изменения',
            'works' => 'Работы',
            'sets' => 'Запчасти'
        ];
    }

    public function getGeneration()
    {
        return $this->hasOne(\common\models\Generations::className(), ['id' => 'generation_id']);
    }

    public function getEngine()
    {
        return $this->hasOne(\common\models\Engines::className(), ['id' => 'engine_id']);
    }

    public function getJobs()
    {
        return $this->hasMany(\common\models\Jobs::className(), ['id' => 'job_id'])->viaTable('orders_jobs', ['order_id' => 'id']);
    }

    public function getParts()
    {
        return $this->hasMany(\common\models\Parts::className(), ['id' => 'part_id'])->viaTable('orders_parts', ['order_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $engine_links = \yii\helpers\ArrayHelper::map(\common\models\EnginesJobs::find()->where(['engine_id' => $this->engine_id])->all(), 'id', 'job_id');
            $generations_links = \yii\helpers\ArrayHelper::map(\common\models\JobsGenerations::find()->where(['generation_id' => $this->generation_id])->all(), 'id', 'job_id');
            $years_links = \yii\helpers\ArrayHelper::map(\common\models\YearsJobs::find()->where(['year_id' => $this->year])->all(), 'id', 'job_id');
            $jobs_arr = array_intersect($engine_links, $generations_links, $years_links);
            $stronge_works = \yii\helpers\ArrayHelper::map(\common\models\Jobs::find()->where(['id' => $jobs_arr])
                ->andWhere(['is', 'recomended', null])
                ->asArray()
                ->all(), 'id', 'id');

            if ($this->works) {
                $this->works = array_merge($this->works, $stronge_works);
            } else {
                $this->works = $stronge_works;
            }

            if ($this->works) {
                $parts = array();
                $final_arr = array();
                foreach ($this->works as $key => $value) {
                    $parts_links = \yii\helpers\ArrayHelper::map(\common\models\PartsJobs::find()->where(['job_id' => $value])->all(), 'id', 'part_id');
                    if ($this->sets && in_array($value, array_keys($this->sets))) {
                        foreach ($this->sets as $k => $v) {
                            $arr = explode('_', $v);
                            if ($k == $value) {
                                if ($arr[0] == 'original') {
                                    $parts[] = \yii\helpers\ArrayHelper::map(\common\models\Parts::find()->where(['id' => $parts_links, 'original' => 1])->all(), 'id', 'id');
                                    continue;
                                }
                                $parts[] = \yii\helpers\ArrayHelper::map(\common\models\Parts::find()->where(['id' => $parts_links])->andWhere(['is', 'original', null])->all(), 'id', 'id');
                            }
                        }
                    } elseif (!$this->sets || $this->sets && !in_array($value, array_keys($this->sets))) {
                        $parts[] = \yii\helpers\ArrayHelper::map(\common\models\Parts::find()->where(['id' => $parts_links])->andWhere(['is', 'original', null])->all(), 'id', 'id');
                    }
                }

                foreach ($parts as $key => $value) {
                    foreach ($value as $k => $v) {
                        $final_arr[] = $v;
                    }
                }

                $this->detales = $final_arr;
            }

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        
        $jobs_arr = array();
        $parts_arr = array();
        $recommend_jobs = array();
        $jobs_price = 0;
        $rec_price = 0;
        $parts_price = 0;

        if ($this->works && !empty($this->works)) {

            $request = Yii::$app->request->post();
            $ranking_works = array_merge($request['mand'] ?? [], $request['rec'] ?? []);
            $this->unlinkAll('jobs', true);

            foreach ($ranking_works as $value) {
                $item = \common\models\Jobs::findOne($value);
                $this->link('jobs', $item);
                if ($item->recomended) {
                    // new email data sending
                    $recommend_jobs[$value]['title'] = $item->title;
                    $recommend_jobs[$value]['price'] = $item->price;
                    $rec_price += $item->price;
                } else {
                    $jobs_arr[$value]['title'] = $item->title;
                    $jobs_arr[$value]['price'] = $item->price;
                    $jobs_price += $item->price;
                }
            }
        }

        if ($this->detales && !empty($this->detales)) {
            $this->unlinkAll('parts', true);
            foreach ($this->detales as $value) {
                $item = \common\models\Parts::findOne($value);
                $this->link('parts', $item);
                $parts_arr[$value]['title'] = $item->title;
                $parts_arr[$value]['code'] = $item->code;
                $parts_arr[$value]['price'] = $item->price;
                $parts_price += $item->price;
            }
        }

        $generation = \common\models\Generations::findOne($this->generation_id);
        $engine = \common\models\Engines::findOne($this->engine_id);
        $age = \common\models\Years::findOne($this->year);

        $new_client_mail_body = [
            'model' => 'Volvo ' . $this->model,
            'gen' => $generation->title,
            'motor' => $engine->title,
            'age' => $age->mileage,
            'recommend' => $recommend_jobs,
            'jobs_price' => $jobs_price,
            'rec_price' => $rec_price,
            'parts_price' => $parts_price,
            'total' => $jobs_price + $rec_price + $parts_price
        ];

        $old_mail_body = [
            'jobs' => $jobs_arr,
            'parts' => $parts_arr
        ];

        $mail_data = [
            'author' => 'Заказ:',
            'body' => ArrayHelper::merge($old_mail_body, $new_client_mail_body),
            'mail' => $this->email,
            'phone' => $this->phone,
            'file' => '',
        ];

        Yii::$app->mailer->compose('message', $mail_data)
            ->setFrom(['newsite@inavtospb.ru' => 'Сообщение с сайта inavtospb.ru'])
            ->setTo($this->email)
            ->setSubject('Заявка')
            ->send();

        Yii::$app->mailer->compose('message', $mail_data)
            ->setFrom(['newsite@inavtospb.ru' => 'Сообщение с сайта inavtospb.ru'])
            ->setTo('master@inavtospb.ru')
            ->setSubject('Заявка')
            ->send();

        parent::afterSave($insert, $changedAttributes);
    }
}
