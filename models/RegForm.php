<?php


namespace app\models;


use Yii;
use yii\base\Model;

class RegForm extends Model {
    public  $username;
    public  $password;
    public  $email;


    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Это имя занято.' ],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Пользователь с таким email существует.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function save(){
        if (!$this->validate()) {
            return null;
        }
        $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password); //хешируем пароль
        $auth_key = Yii::$app->security->generateRandomString();

        $User = new User();
        $User->username = $this->username;
        $User->password_hesh = $hash;
        $User->email = $this->email;
        $User->auth_key = $auth_key;
        $User->save(false);

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('user');
        $auth->assign( $userRole , $User->getId());

      return  $User;

    }
}