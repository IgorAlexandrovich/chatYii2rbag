<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }




    public static function findIdentity($id)
    {
        return static::findOne($id);//достаем пользователя по id
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }


    public static function findByUsername($username)
    {
        return static::findOne(['email'=>$username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }


    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }


    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password,$this->password_hesh);// сравнение хешированного пароля

    }

}
