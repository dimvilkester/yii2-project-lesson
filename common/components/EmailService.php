<?php

namespace common\components;

use Yii;
use yii\base\Component;
use common\components\UserNotificationInterface;

/**
 * @author mr. Anderson
 */
class EmailService extends Component {

   /**
    * @param UserNotificationInterface $event
    * @return bool
    */
    public function notifyUser(UserNotificationInterface $event) {
        Yii::$app->mailer->compose()
                ->setFrom('service.email@yii2frontend.com')
                ->setTo($event->getEmail())
                ->setSubject($event->getSubject())
                ->send();
    }
    
   /**
    * @param UserNotificationInterface $event
    * @return bool
    */
    public function notifyAdmins(UserNotificationInterface $event) {
        
        Yii::$app->mailer->compose()
                ->setFrom('service.email@yii2frontend.com')
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject($event->getSubject())
                ->send();
    }

}