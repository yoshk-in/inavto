<?php

namespace backend\controllers;

use backend\controllers\SiteController;
use common\models\JobsRank;
use Closure;
use common\helpers\Calc;
use common\helpers\CalcPreview;
use Yii;
use yii\web\View;

class CalcPreviewController extends SiteController
{
    public $cars;
    public $calcPreview;

    public function actionIndex()
    {
        $this->skipConflictJqueryVersion();
        $this->calcPreview = CalcPreview::init();
        $this->calcPreview->yiiView = $this->getView();
        echo $this->calcPreview->calcPreviewFix();
        $print = $this->render('@frontend/views/site/index', [
            'cars' => Calc::getCars(),
            'is_backend_preview' => true,
        ]); 
        return $print;
    }

    private function skipConflictJqueryVersion()
    {
        Yii::$app->view->on(View::EVENT_END_BODY, function () {
            $this->calcPreview->skipYiiJquery();            
        });
    }

    public function actionSave()
    {
        $data = Yii::$app->request->post();
        if (empty($data) || !isset($data['mand']) ) return $this->redirect('calc-preview');
        $rec = $data['rec'] ?? [];
        $jobs = array_merge($data['mand'], $rec);
        $jobsId_rank = array_flip($jobs);
        $mandId_rank = array_flip($data['mand']);
        $recId_rank = array_flip($rec);
        $models = JobsRank::find()
            ->where(['job_id' => $jobs])
            ->all();
        
        foreach ($models as $mod) {
            $new_rank = $mandId_rank[$mod->job_id] ?? $recId_rank[$mod->job_id];
            unset($jobsId_rank[$mod->job_id]);
            // if ($new_rank === $mod->ranking) continue;          
            $mod->ranking = $new_rank;
            $mod->save();
        }

        foreach($jobsId_rank as $id => $rank) {
            $model = new JobsRank();
            $model->job_id = $id;
            $model->ranking = $rank;
            $model->save();
        }

        $req['modelName'] = 'Volvo'. $data['model'];
        $engine_id = $data['motor'];
        $generation_id = $data['generation'];
        $year_id = $data['range'];

        
        // if ($model->save()) {
        Yii::$app->session->setFlash('success', "Данные отправлены");
        Yii::$app->cacheFrontend->delete($cache_key = str_replace(' ', '', $req['modelName']) . 'calculation' . $engine_id . $generation_id . $year_id);
        // } else {
        //     Yii::$app->session->setFlash('error', "Ошибка отправки");
        //     Yii::$app->session->setFlash('show', "show");
        // }
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function dropCalcCache()
    {

    }

    // private function calcPreviewFix($calcPreview) 
    // {
    //     $print = vsprintf("
    //     <script type='text/javascript'>
    //         var PATH = '%s/';
    //     </script>
    //     <script type='text/javascript' src='%s/js/lib/jquery-1.8.3.min.js'></script>
    //     <script type='text/javascript' src='%s/js/core3.js'></script>
    //     <script type='text/javascript' src='%s/js/zoomImage.js'></script>        
    //     <link type='text/css' rel='Stylesheet' media='screen' href='%s/css/common.css'/>
    //     <script type='text/javascript' src='%s/js/lib/jquery-ui.min.js'></script>
    //     ", array_fill(0, 6, $this->calcPreview->getAssetsRootPath()));
    //     echo $print;
    // }
}
