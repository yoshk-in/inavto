<?php

namespace backend\controllers;

use Yii;
use common\models\JobsCategories;
use common\models\Cars;
use backend\models\SearchJobsCategories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * JobsCategoriesController implements the CRUD actions for JobsCategories model.
 */
class Jobs_categoriesController extends SiteController
{
    /**
     * Lists all JobsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchJobsCategories();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobsCategories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JobsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobsCategories();
        
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        $parents = \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['parent' => null])->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Категория добавлена");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cars' => $cars,
            'parents' => $parents
        ]);
    }

    /**
     * Updates an existing JobsCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        $parents = \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['parent' => null])->andWhere(['!=', 'id', $id])->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Категория изменена");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cars' => $cars,
            'parents' => $parents
        ]);
    }

    /**
     * Deletes an existing JobsCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Категория удалена");
        return $this->redirect(['index']);
    }

    /**
     * Finds the JobsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobsCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionSetcats()
    {
        $srv_works = array(
            array('id_work' => '7','name' => 'Замена масла в двигателе (защита снята)','type' => 'service','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2018-12-03 18:06:32','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '9','name' => 'Замена воздушного фильтра','type' => 'service','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2017-09-30 01:17:00','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '11','name' => 'Замена свечей зажигания','type' => 'mixed','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2017-08-08 14:14:19','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '13','name' => 'Замена ремня ГРМ и роликов + приводные с роликами','type' => 'mixed','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2017-10-14 17:30:32','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '17','name' => 'Замена жидкости системы охлаждения','type' => 'service','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2017-10-16 21:13:38','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '18','name' => 'Контрольный осмотр','type' => 'mixed','system' => 'diagnostika','discr'=>'диагностика узлов и систем','date_modify' => '2017-10-16 21:20:15','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '19','name' => 'Замена топливного фильтра','type' => 'service','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2017-10-16 21:15:44','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '20','name' => 'Замена фильтра салона','type' => 'service','system' =>  'kuzov','discr'=>'работы по уходу за кузовом и салоном','date_modify' => '2017-10-16 21:19:09','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '21','name' => 'Мойка технологическая','type' => 'mixed','system' =>  'kuzov','discr'=>'работы по уходу за кузовом и салоном','date_modify' => '2018-02-15 16:36:06','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '22','name' => 'Снять поставить защиту двигателя (пыльник)','type' => 'mixed','system' =>  'kuzov','discr'=>'работы по уходу за кузовом и салоном','date_modify' => '2018-12-03 18:04:19','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '23','name' => 'Проверка наружного освещения','type' => 'service','system' =>  'electro','discr'=>'обслуживание электрики','date_modify' => '2017-09-21 15:32:46','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '25','name' => 'Замена тормозной жидкости','type' => 'service','system' =>  'tormoz','discr'=>'обслуживание тормозной системы','date_modify' => '2017-09-21 15:26:12','date_add' => '2017-09-20 20:04:06','active' => NULL),
            array('id_work' => '40','name' => 'Замена масла в ГУ руля','type' => 'service','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2017-10-16 21:14:29','date_add' => '2017-09-21 10:44:33','active' => NULL),
            array('id_work' => '44','name' => 'Замена свечей накаливания','type' => 'mixed','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2017-10-16 21:15:30','date_add' => '2017-09-30 00:44:05','active' => NULL),
            array('id_work' => '45','name' => 'Замена приводного ремня и роликов','type' => 'mixed','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2017-09-30 01:00:49','date_add' => '2017-09-30 01:00:49','active' => NULL),
            array('id_work' => '52','name' => 'Замена масла в АКПП (частичная) + сброс счетчика окисления','type' => 'service','system' => 'akpp','discr'=>'обслуживание коробки передач','date_modify' => '2017-10-12 12:29:07','date_add' => '2017-10-12 12:29:07','active' => NULL),
            array('id_work' => '53','name' => 'Проверка развал-схождения','type' => 'service','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2017-10-12 12:30:36','date_add' => '2017-10-12 12:30:36','active' => NULL),
            array('id_work' => '54','name' => 'Замена масла в муфте HALDEX','type' => 'service','system' => 'akpp','discr'=>'обслуживание коробки передач','date_modify' => '2017-10-12 12:34:08','date_add' => '2017-10-12 12:34:08','active' => NULL),
            array('id_work' => '55','name' => 'Замена муфты генератора','type' => 'mixed','system' =>  'electro','discr'=>'обслуживание электрики','date_modify' => '2017-10-19 11:05:03','date_add' => '2017-10-19 11:05:03','active' => NULL),
            array('id_work' => '57','name' => 'Замена масла + фильтр в КП MPS6 (робот)','type' => 'service','system' => 'akpp','discr'=>'обслуживание коробки передач','date_modify' => '2018-02-16 15:05:59','date_add' => '2018-02-16 15:03:34','active' => NULL),
            array('id_work' => '59','name' => 'Диск тормозной задний (оба) + колодки (эл. ручник). Снять и установить.','type' => 'repair','system' =>  'tormoz','discr'=>'обслуживание тормозной системы','date_modify' => '2018-07-31 15:13:42','date_add' => '2018-07-31 15:13:42','active' => NULL),
            array('id_work' => '60','name' => 'Диск тормозной задний (оба) + колодки (все). Снять и установить.','type' => 'repair','system' =>  'tormoz','discr'=>'обслуживание тормозной системы','date_modify' => '2018-07-31 15:15:47','date_add' => '2018-07-31 15:15:47','active' => NULL),
            array('id_work' => '61','name' => 'Диск тормозной передний (оба) + колодки (все). Снять и установить.','type' => 'repair','system' =>  'tormoz','discr'=>'обслуживание тормозной системы','date_modify' => '2018-07-31 15:17:51','date_add' => '2018-07-31 15:17:51','active' => NULL),
            array('id_work' => '62','name' => 'Колодки тормозные переднии  - замена. (колеса сняты).','type' => 'repair','system' =>  'tormoz','discr'=>'обслуживание тормозной системы','date_modify' => '2018-08-02 13:21:23','date_add' => '2018-08-02 13:18:18','active' => NULL),
            array('id_work' => '63','name' => 'Колодки тормозные заднии - замена.','type' => 'repair','system' =>  'tormoz','discr'=>'обслуживание тормозной системы','date_modify' => '2018-08-02 13:20:55','date_add' => '2018-08-02 13:20:55','active' => NULL),
            array('id_work' => '64','name' => 'Колодки тормозные заднии (электрич. ручник). Замена','type' => 'repair','system' =>  'tormoz','discr'=>'обслуживание тормозной системы','date_modify' => '2018-08-02 13:23:34','date_add' => '2018-08-02 13:23:34','active' => NULL),
            array('id_work' => '65','name' => 'Амортизатор передний. Снять и установить.','type' => 'repair','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:27:07','date_add' => '2018-08-02 13:25:49','active' => NULL),
            array('id_work' => '66','name' => 'Сайлентблок переднего рычага (задний). Замена.','type' => 'repair','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:29:41','date_add' => '2018-08-02 13:28:55','active' => NULL),
            array('id_work' => '67','name' => 'Подшипник ступицы передний. Замена.','type' => 'repair','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:31:43','date_add' => '2018-08-02 13:31:43','active' => NULL),
            array('id_work' => '68','name' => 'Подшипник ступицы задний. Замена.','type' => 'repair','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:32:42','date_add' => '2018-08-02 13:32:42','active' => NULL),
            array('id_work' => '69','name' => 'Развал-схождение передняя ось. Проверить и исправить.','type' => 'mixed','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:35:34','date_add' => '2018-08-02 13:35:34','active' => NULL),
            array('id_work' => '70','name' => 'Развал-схождение 2 оси. Проверить и исправить.','type' => 'mixed','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:37:11','date_add' => '2018-08-02 13:37:11','active' => NULL),
            array('id_work' => '71','name' => 'Сайлентблоки переднего подрамника. Замена 4 шт.','type' => 'repair','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:55:37','date_add' => '2018-08-02 13:55:37','active' => NULL),
            array('id_work' => '72','name' => 'Сайлентблоки заднего подрамника. Замена 4 шт.','type' => 'repair','system' => 'podveska','discr'=>'работы по обслуживанию подвески и рулевого управления','date_modify' => '2018-08-02 13:56:52','date_add' => '2018-08-02 13:56:52','active' => NULL),
            array('id_work' => '73','name' => 'Радиатор - снять и установить','type' => 'repair','system' => 'dvigatel','discr'=>'обслуживание двигателя','date_modify' => '2018-08-02 13:59:16','date_add' => '2018-08-02 13:59:16','active' => NULL),
            array('id_work' => '74','name' => 'Проверка качества охлаждающей и тормозной жидкостей (при необходимости замена)','type' => 'service','system' => 'diagnostika','discr'=>'диагностика узлов и систем','date_modify' => '2019-02-21 13:41:57','date_add' => '2019-02-21 13:41:57','active' => NULL)
          );
        $parents = JobsCategories::find()->where(['parent' => null, 'service' => 1])->all();
       // $cats_titles = \yii\helpers\ArrayHelper::map(JobsCategories::find()->select('id', 'title')->all(), 'id', 'title');
    //    $cats_cars = \yii\helpers\ArrayHelper::map(JobsCategories::find()->select('id', 'car_id')->all(), 'id', 'car_id');
        foreach($parents as $key => $value){
            $childs = JobsCategories::find()->where(['parent' => $value->parent]);
            foreach($childs as $k => $v){
                $model = new Jobs();
                $model->title = $v['name'];
                $model->service = null;
                $model->car_id = $value->car->id;
                $model->parent = $value->id;
                $model->save();
            }
        }
        Yii::$app->session->setFlash('success', "Категории занесены");
        return $this->redirect(['index']);
    }
    
   /* public function setAlias($model)
    {
        if(!$model->alias){
            $model->on(JobsCategories::EVENT_AFTER_INSERT, function($event){
               $cat = $this->findModel($event->data);
               $cat->alias = \common\helpers\HelpersFunctions::translit($cat->menu_title);
               $cat->save();
            }, $model->id);
            $model->trigger(JobsCategories::EVENT_AFTER_INSERT);
        }
    }*/
    
}
