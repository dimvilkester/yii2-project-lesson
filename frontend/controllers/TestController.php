<?php

namespace frontend\controllers;

use frontend\controllers\behaviors\AccessBehavior;

class TestController extends \yii\web\Controller
{
    
    public function behaviors(){
        return [
            AccessBehavior::className(),
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionTest()
    {
        return $this->render('test');
    }

}
