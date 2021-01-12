<?php

namespace app\models;


use Yii;
use yii\base\Model;

class MessageForm extends Model
{

    public $message;

    public function rules()
    {

        return [

            ['message','string', 'min' => 1, 'max' => 3000],

        ];
    }
    public function save() {

        $message = new Message();
        $message ->user_id = Yii::$app->user->identity->id;
        $message ->created_at = date( "j.m.y г. H:i ");
        $message ->message = $this->message;
        $message ->save();
    }
}
