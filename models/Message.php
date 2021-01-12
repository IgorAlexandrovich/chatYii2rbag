<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property string $created_at
 * @property int $censored
 *
 * @property User $user
 */



class Message extends \yii\db\ActiveRecord
{

    const STATUS_ACTIV = 0;
    const STATUS_BLOCK = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['user_id', 'message', 'created_at'], 'required'],
            [['user_id', 'censored'], 'integer'],
            [['message'], 'string', 'max' => 3000],
            [['created_at'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'message' => 'Сообщения',
            'created_at' => 'Когда написано',
            'censored' => 'Cтатус показа',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function setMesaage($constStatusMessage,$Message,$pagination){
        $message = $Message->where(['censored' => $constStatusMessage])
            ->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $message;
    }
    public function setMesaageall($Message,$pagination){
        $message = $Message
            ->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $message;
    }

}
