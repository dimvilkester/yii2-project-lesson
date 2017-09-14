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
class SignupForm extends Model {
    
    public $username;
    public $email;
    public $password;
    
    /**
     * 
     * @return type
     */
    public function rules() {
        
        return [
            [['username'], 'trim'],
            [['username'], 'required'],
            [['username'], 'string', 'min' => 2, 'max' => 255],
            [['username'], 'unique', 'targetClass' => User::className()],
            
            [['email'], 'trim'],
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],
            //Проверка поля email на уникальность для таблицы user
            //Указываем 'targetClass' и полный путь до модели AR User::className()
            [['email'], 'unique', 'targetClass' => User::className()],
            
            [['password'], 'required'],
            [['password'], 'string', 'min' => 6],
        ];
    }

    /**
     * Save user
     * @return User || Null
     */
    public function save() {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $user->email = $this->email;
            $user->created_at = $time = time();
            $user->updated_at = $time;
            
            // метод save() вернет TRUE || FALSE
            if ($user->save()){
                Yii::$app->emailService->notifyUser($user, 'Welcome');
                Yii::$app->emailService->notifyAdmins('Зарегистрировался новый пользователь');
                
                return $user;
            }
        }
    }
    
    /**
     * @return array parametrs
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'email' => 'Email',
        ];
    }

}