<?php

namespace common\components;

use Yii;
use yii\base\Component;
use common\components\UsernotificationInterface;

/**
 * for example EmailService
 * 
 * Относиться к занятию события Events, точнее как без них обойтись
 *
 * @author mr. Anderson
 */
class EmailService extends Component {

   /**
    * @param UsernotificationInterface $user
    * @param string $subject
    * @return bool
    * 
    * реализация интерфейса usernotificationInterface необходима для того, 
    * чтобы на вход метода notifyUser($user) случайно не передали другой класс, 
    * где отсутствует переменная email.
    * Это правило хорошего тона!
    */
    public function notifyUser(UsernotificationInterface $user, $subject = NULL) {
        Yii::$app->mailer->compose()
                ->setFrom('service.email@yii2frontend.com')
                ->setTo($user->getEmail())
                ->setSubject($subject)
                ->send();
    }
    
   /**
    * @param string $subject
    * @return bool
    */
    public function notifyAdmins($subject) {
        Yii::$app->mailer->compose()
                ->setFrom('service.email@yii2frontend.com')
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject($subject)
                ->send();
    }

}