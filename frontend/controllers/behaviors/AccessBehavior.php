<?php

namespace frontend\controllers\behaviors;

use Yii;
use yii\base\Behavior;
use yii\web\Controller;

/**
 * @author mr. Anderson
 */
class AccessBehavior extends Behavior {

    public function events() {
        return [
            Controller::EVENT_BEFORE_ACTION => 'checkAccess',
        ];
    }

    public function checkAccess() {
        if (Yii::$app->user->isGuest) {
            Yii::$app->controller->redirect(['site/index']);
        }
    }

}
