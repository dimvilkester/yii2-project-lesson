<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\forms\SignupForm;

class UserController extends Controller
{
    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('info', 'User register completed!');
            return $this->redirect(['site/index']);
        }
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

}
