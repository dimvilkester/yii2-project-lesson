<?php

namespace frontend\models\events\user;

use yii\base\Event;
use frontend\models\User;
use common\components\UserNotificationInterface;

/**
 * @author mr. Anderson
 */
class UserRegisteredEvent extends Event implements UserNotificationInterface
{
    /**
     *
     * @var User 
     */
    public $user;
    
    /**
     *
     * @var string
     */
    public $subject;
    
    /**
     * @return string
     */
    public function getSubject() {
        return $this->subject;
    }
    
    /**
     * @return string
     */
    public function getEmail() {
        return $this->user->email;
    }
}
