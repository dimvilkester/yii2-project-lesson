<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\forms\SignupForm;
use frontend\models\forms\LoginForm;

class UserController extends Controller
{

    public function actionSignup()
    {
        $model = new SignupForm();
        
        if($model->load(Yii::$app->request->post()) && $user = $model->save()){
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('info', 'User register completed!');
            return $this->redirect(['site/index']);
        }
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
    public function actionLogin()
    {
        $model = new LoginForm();
        
        if($model->load(Yii::$app->request->post()) && $model->login()){
            Yii::$app->session->setFlash('info', 'User login completed!');
            return $this->redirect(['site/index']);
        }
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
      
        return $this->redirect(['site/index']);
    }

}
