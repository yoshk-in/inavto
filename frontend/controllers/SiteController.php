<?php
namespace frontend\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ContactForm;
use frontend\models\Orders;
use common\models\Pages;
use common\models\Messages;

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
                        'actions' => ['logout', 'banner'],
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
    
    public function beforeAction($action)
    {
     //  print_r(Yii::$app->user);
     //   exit();
        $cookies = Yii::$app->request->cookies;
       if($cookies->getValue('version') && $cookies->getValue('version') == 'mobile'){
           $this->layout = 'mobile';
       }
        return parent::beforeAction($action);
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
        $cars = \common\models\Cars::find()->all();
     
        $main_page = Yii::$app->cache->get('main_page');
        if(!$main_page){
            $main_page = Pages::find()->where(['main' => 1])->one();
            Yii::$app->cache->set('main_page', $main_page, $this->cache_time);
        }
        
        $this->setMeta($main_page->meta_title, $main_page->keywords, $main_page->description);
        
        if($this->layout == 'mobile'){
            return $this->render('mobile', [
                'main_page' => $main_page,
            ]);
        }
        return $this->render('index', [
            'main_page' => $main_page,
            'cars' => $cars,
        ]);
    }
    
    public function actionMessage()
    {
        $message = new Messages();
        
        if($message->load(Yii::$app->request->post())){
            $flag = $this->checkSpam(Yii::$app->request->post('recaptcha_response'));
            if($flag == 0){
                Yii::$app->session->setFlash('error'.$message->flag, "Проверка не спам не пройдена");
                Yii::$app->session->setFlash('show'.$message->flag, "show");
                return $this->redirect(Yii::$app->request->referrer);
            }
            if($message->save()){
                Yii::$app->session->setFlash('success'.$message->flag, "Данные отправлены");
                Yii::$app->session->setFlash('show'.$message->flag, "show");
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error'.$message->flag, "Ошибка отправки");
                Yii::$app->session->setFlash('show'.$message->flag, "show");
                return $this->redirect([Yii::$app->request->referrer, 'message' => $message]);
            }
        }
    }
    
    public function actionOrder()
    {
        $model = new Orders();
         if($model->load(Yii::$app->request->post())){
            $flag = $this->checkSpam(Yii::$app->request->post('recaptcha_response'));
            if($flag == 0){
                Yii::$app->session->setFlash('error', "Проверка не спам не пройдена");
                Yii::$app->session->setFlash('show', "show");
                return $this->redirect(Yii::$app->request->referrer);
            }
            $model->model = Yii::$app->request->post('model');
            $model->generation_id = Yii::$app->request->post('generation');
            $model->engine_id = Yii::$app->request->post('motor');
            $model->year = Yii::$app->request->post('range');
            $model->works = Yii::$app->request->post('rec');
            $model->sets = Yii::$app->request->post('set');
            if($model->save()){
                Yii::$app->session->setFlash('success', "Данные отправлены");
                Yii::$app->session->setFlash('show', "show");
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error', "Ошибка отправки");
                Yii::$app->session->setFlash('show', "show");
                return $this->redirect([Yii::$app->request->referrer, 'model' => $model]);
            }
        }
    }
    
    public function checkSpam($flag = false)
    {
        if($flag == false){
            return 0;
        }

        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6LdA1L4UAAAAABJD-5tVHR_pTsrnweWAX0dOKSct';
        $recaptcha_response = $flag;

        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        if ($recaptcha->score >= 0.5) {
             return 1;
        } else {
            return 0;
        }
    }
    
    public function actionVersion()
    {
        if(Yii::$app->request->get()){
            $cookies = Yii::$app->response->cookies;
            if(Yii::$app->request->get('version') == 'desktop'){
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'version',
                    'value' => 'desktop',
                ]));
            }else{
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'version',
                    'value' => 'mobile',
                ]));
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
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
    /*public function actionContact()
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
    }*/
    
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
        
        $this->setMeta($model->meta_title, $model->keywords, $model->description);
        
        return $this->render('page', ['model' => $model]);
    }
    
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
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
       if($job['parts'] && !empty($job['parts'])){
           $original_count_price = 0;
           $analog_count_price = 0;
           $flag = 0;
           $key1 = 0;
           $key2 = 0;
           $prices = array();
           $original_prices = array();
           $analog_prices = array();
            foreach($job['parts'] as $key => $value){
                if($value['original']){
                    $original_count_price += $value['price'];
                    $new_job['sets'][0]['id_set'] = 'original_' . $flag;
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
                    $new_job['sets'][0]['parts'][$key1]['totalPrice'] = $value['price'];
                    $key1++;
                }else{
                    $analog_count_price += $value['price'];
                    $new_job['sets'][1]['id_set'] = 'analog_' . $flag;
                    $new_job['sets'][1]['setName'] = 'Аналог';
                    $new_job['sets'][1]['price'] = $analog_count_price;
                    $prices[1] = $analog_count_price;
                    $new_job['sets'][1]['parts'][$key2]['count'] = 1;
                    $new_job['sets'][1]['parts'][$key2]['price'] = $value['price'];
                    $analog_prices[] = $value['price'];
                    $new_job['sets'][1]['parts'][$key2]['id_part'] = $value['id'];
                    $new_job['sets'][1]['parts'][$key2]['partName'] = $value['title'];
                    $new_job['sets'][1]['parts'][$key2]['articul'] = $value['code'];
                    $new_job['sets'][1]['parts'][$key2]['original'] = $value['original'];
                    $new_job['sets'][1]['parts'][$key2]['vendor'] = $value['brand']['title'];
                    $new_job['sets'][1]['parts'][$key2]['totalPrice'] = $value['price'];
                    $key2++;
                }
                $flag++;
            }
            $new_job['sets'] = array_values($new_job['sets']);
            $new_job['minPartsPrice'] = min($prices);
            $new_job['maxPartsPrice'] = max($prices);
       }
       return $new_job;
    }
    
    public function getSet()
    {
        $original_count_price += $value['price'];
        $new_job['sets'][1]['id_set'] = $flag+1;
        $new_job['sets'][1]['setName'] = 'Оригинал';
        $new_job['sets'][1]['price'] = $original_count_price;
        $prices[1] = $original_count_price;
        $new_job['sets'][1]['parts'][$key1]['count'] = 1;
        $new_job['sets'][1]['parts'][$key1]['price'] = $value['price'];
        $original_prices[] = $value['price'];
        $new_job['sets'][1]['parts'][$key1]['id_part'] = $value['id'];
        $new_job['sets'][1]['parts'][$key1]['partName'] = $value['title'];
        $new_job['sets'][1]['parts'][$key1]['articul'] = $value['code'];
        $new_job['sets'][1]['parts'][$key1]['original'] = $value['original'];
        $new_job['sets'][1]['parts'][$key1]['vendor'] = $value['brand']['title'];
        $new_job['sets'][1]['parts'][$key1]['totalPrice'] = $value['price'];
        $key1++;
    }
    
    public function actionBanner($id)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['/site/index']);
        }
        $model = \common\models\Banners::findOne($id);
         if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->setFlash('success_'.$model->id, "Данные сохранены");
                Yii::$app->session->setFlash('show_'.$model->id, "show");
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error_'.$model->id, "Ошибка отправки");
                Yii::$app->session->setFlash('show_'.$model->id, "show");
                return $this->redirect([Yii::$app->request->referrer, 'model' => $model]);
            }
        }
    }
}
