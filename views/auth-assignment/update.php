<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = 'Изменить роль: ' . $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Изменение роли', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="auth-assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
