<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'censored')->radioList([
        1 => 'Заблокировать сообщение',
        0 => 'Разблокировать сообщение'
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
