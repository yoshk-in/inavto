<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;
use common\models\Pages;
use common\models\Contacts;

/**
 * Description of ContactsController
 *
 * @author Vadim
 */
class ContactsController extends SiteController
{
    public function actionIndex()
    {
        $model = Pages::find()->where(['main' => 2])->one();
        /*$contacts = Contacts::find()->with(['service'])->where(['type' => [1,2]])->asArray()->all();
        $arr = array();
        $arr2 = array();
        $arr3 = array();
        foreach($contacts as $key => $value){
            if($value['type'] == 1){
                if(in_array($value['service_id'], $arr)){
                    
                }else{
                    
                }
                $arr2[] = $value['service_id'];
                $arr['service']['service_id'] = $value['service_id'];
            }else{
                $arr['parts'][] = $value;
            }
        }*/
        return $this->render('index', ['model' => $model]);
    }
}
