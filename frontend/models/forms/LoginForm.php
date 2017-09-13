<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\User;

/**
 * Description of SignupForm
 *
 * @author mr. Anderson
 */
class LoginForm extends Model {

    public $username;
    public $password;

    /**
     * 
     * @return array parametrs
     */
    public function rules() {

        return [
                [['username'], 'trim'],
                [['username'], 'required'],
                [['password'], 'required'],
                [['password'], 'validatePassword'],
        ];
    }

    /**
     * @return array parametrs
     */
    public function attributeLabels() {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
        ];
    }

    public function login() {
        if ($this->validate()) {
            $user = User::findByUsername($this->username);        
            return Yii::$app->user->login($user);
        }
        return FALSE;
    }

    public function validatePassword($attribute, $params) {

        $user = User::findByUsername($this->username);

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorection {$attribute}');
        }
    }

}
