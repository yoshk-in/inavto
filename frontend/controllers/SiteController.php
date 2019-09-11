<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Orders;
use common\models\Pages;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $cache_time = 60;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Orders();
     
        $main_page = Yii::$app->cache->get('main_page');
        if(!$main_page){
            $main_page = Pages::find()->where(['main' => 1])->one();
            Yii::$app->cache->set('main_page', $main_page, $this->cache_time);
        }
        
        if($model->load(Yii::$app->request->post())){
            $model->model = Yii::$app->request->post('model');
            $model->generation_id = Yii::$app->request->post('generation');
            $model->engine_id = Yii::$app->request->post('motor');
            $model->year = Yii::$app->request->post('range');
            $model->year = Yii::$app->request->post('range');
            $model->works = Yii::$app->request->post('rec');
            if($model->save()){
                Yii::$app->session->setFlash('success', "Данные отправлены");
                Yii::$app->session->setFlash('show', "show");
                $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error', "Ошибка отправки");
                Yii::$app->session->setFlash('show', "show");
                $this->redirect([Yii::$app->request->referrer, 'model' => $model]);
            }
        }
        
        return $this->render('index', [
            'model' => $model,
            'main_page' => $main_page,
        ]);
    }
    
    

    /**
     * Logs in a user.
     *
     * @return mixed
     *
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     *
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionPage($alias)
    {
        $model = Yii::$app->cache->get('page_'.$alias);
        if(!$model){
            $model = Pages::find()->where(['alias' => $alias])->one();
            Yii::$app->cache->set('page_'.$alias, $model, $this->cache_time);
        }
        
        if(!$model){
             throw new \yii\web\HttpException(404, 'Такой страницы нет');
        }
        
        return $this->render('page', ['model' => $model]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     *
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     *
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     *
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     *
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     *
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     *
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }*/
    
    public function actionCalculator()
    {
        $req = Yii::$app->request->get();
        if($req){
            
            $engine_id = $req['motorId'];
            $generation_id = $req['genId'];
            $year_id = $req['range'];
            
            $responce = Yii::$app->cache->get(str_replace(' ', '', $req['modelName']) . 'calculation' . $engine_id . $generation_id . $year_id);
            if(!$responce){
                $categories_links = \yii\helpers\ArrayHelper::map(\common\models\JobcatsJobs::find()->where(['job_category_id' => \yii\helpers\ArrayHelper::map(\common\models\JobsCategories::find()->where(['service' => 1])->all(), 'id', 'id')])->all(), 'id', 'job_id');
                $engine_links = \yii\helpers\ArrayHelper::map(\common\models\EnginesJobs::find()->where(['engine_id' => $engine_id])->all(), 'id', 'job_id');
                $generations_links = \yii\helpers\ArrayHelper::map(\common\models\JobsGenerations::find()->where(['generation_id' => $generation_id])->all(), 'id', 'job_id');
                $years_links = \yii\helpers\ArrayHelper::map(\common\models\YearsJobs::find()->where(['year_id' => $year_id])->all(), 'id', 'job_id');
                $jobs_arr = array_intersect($engine_links, $generations_links, $years_links, $categories_links);
                $jobs = \common\models\Jobs::find()->where(['id' => $jobs_arr, ])
                        ->with([
                            'parts' => function($query){
                                return $query->with('brand');
                            }
                         ])
                        ->asArray()
                        ->all();

                $responce = $this->getJobs($jobs, $req['requestId']);
                Yii::$app->cache->set(str_replace(' ', '', $req['modelName']) . 'calculation' . $engine_id . $generation_id . $year_id, $responce, $this->cache_time);
            }
            
            return json_encode($responce);
        }
    }
    
    public function getJobs($arr = array(), $req)
    {
        $responce = array();
        $responce['requestId'] = $req;
        $responce['mandatoryWorksPrice'] = 0;
        $responce['mandatoryPartsMin'] = 0;
        $responce['recommendedWorksPrice'] = 0;
        $responce['recommendedPartsMin'] = 0;
        $k1 = 0;
        $k2 = 0;
        foreach($arr as $key => $value){
            if(@$value['recomended']){
                $responce['works']['recommended'][$k1] = $this->getJob($value);
                if(@$responce['works']['recommended'][$k1]['price']){
                    $responce['recommendedWorksPrice'] += $responce['works']['recommended'][$k1]['price'];
                }
                if(@$responce['works']['recommended'][$k1]['minPartsPrice']){
                    $responce['recommendedPartsMin'] += $responce['works']['recommended'][$k1]['minPartsPrice'];
                }
                $k1++;
            }else{
                $responce['works']['mandatory'][$k2] = $this->getJob($value);
                if(@$responce['works']['mandatory'][$k2]['price']){
                    $responce['mandatoryWorksPrice'] += $responce['works']['mandatory'][$k2]['price'];
                }
                if(@$responce['works']['mandatory'][$k2]['minPartsPrice']){
                    $responce['mandatoryPartsMin'] += $responce['works']['mandatory'][$k2]['minPartsPrice'];
                }
                $k2++;
            }
        }
        $responce['totalPrice'] = $responce['mandatoryWorksPrice'] + $responce['mandatoryPartsMin'] + $responce['recommendedWorksPrice'] + $responce['recommendedPartsMin'];
        return $responce;
    }
    
    public function getJob($job = null)
    {
       $new_job = array();
       $new_job['id_work'] = $job['id'];
       $new_job['name'] = $job['title'];
       $new_job['type'] = 'service';
       $new_job['price'] = $job['price'];
       $new_job['minPartsPrice'] = 0;
       $new_job['maxPartsPrice'] = 0;
       $new_job['sets'] = array();
       if(@$job['parts']){
           $original_count_price = 0;
           $analog_count_price = 0;
           $flag = 0;
           $key1 = 0;
           $key2 = 0;
           $prices = array();
           $original_prices = array();
           $analog_prices = array();
           $len = count($job['parts']);
            foreach($job['parts'] as $key => $value){
                if(@$value['original']){
                    $original_count_price += $value['price'];
                    $new_job['sets'][0]['id_set'] = $job['id']+$key;
                    $new_job['sets'][0]['setName'] = 'Оригинал';
                    $new_job['sets'][0]['price'] = $original_count_price;
                    $prices[0] = $original_count_price;
                    $new_job['sets'][0]['parts'][$key1]['count'] = 1;
                    $new_job['sets'][0]['parts'][$key1]['price'] = $value['price'];
                    $original_prices[] = $value['price'];
                    $new_job['sets'][0]['parts'][$key1]['id_part'] = $value['id'];
                    $new_job['sets'][0]['parts'][$key1]['partName'] = $value['title'];
                    $new_job['sets'][0]['parts'][$key1]['articul'] = $value['code'];
                    $new_job['sets'][0]['parts'][$key1]['original'] = $value['original'];
                    $new_job['sets'][0]['parts'][$key1]['vendor'] = $value['brand']['title'];
                    if($flag == $len - 1){
                        foreach($new_job['sets'][0]['parts'] as $k => $v){
                            $new_job['sets'][0]['parts'][$key1]['totalPrice'] = $original_count_price;
                        }
                    }
                    $key1++;
                }else{
                    $analog_count_price += $value['price'];
                    $new_job['sets'][1]['id_set'] = $job['id']+$key;
                    $new_job['sets'][1]['setName'] = 'Аналог';
                    $new_job['sets'][1]['price'] = $original_count_price;
                    $prices[1] = $original_count_price;
                    $new_job['sets'][1]['parts'][$key2]['count'] = 1;
                    $new_job['sets'][1]['parts'][$key2]['price'] = $value['price'];
                    $analog_prices[] = $value['price'];
                    $new_job['sets'][1]['parts'][$key2]['id_part'] = $value['id'];
                    $new_job['sets'][1]['parts'][$key2]['partName'] = $value['title'];
                    $new_job['sets'][1]['parts'][$key2]['articul'] = $value['code'];
                    $new_job['sets'][1]['parts'][$key2]['original'] = $value['original'];
                    $new_job['sets'][1]['parts'][$key2]['vendor'] = $value['brand']['title'];
                    if($flag == $len - 1){
                        foreach($new_job['sets'][1]['parts'] as $k => $v){
                            $new_job['sets'][1]['parts'][$key2]['totalPrice'] = $analog_count_price;
                        }
                    }
                    $key2++;
                }
                $flag++;
            }
        //    $new_job['sets'] = array_values($new_job['sets']);
            $new_job['minPartsPrice'] = min($prices);
            $new_job['maxPartsPrice'] = max($prices);
       }
       return $new_job;
    }
}
