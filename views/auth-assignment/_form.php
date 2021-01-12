<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'item_name')->dropdownList([
        'admin' => 'admin',
        'user' => 'user',
    ]); ?>


    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
