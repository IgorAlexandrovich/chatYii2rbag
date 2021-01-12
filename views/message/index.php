<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Редактирование сообщений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
           [
                   'attribute' => 'user.username',
                    'label' => 'Имя ',
               ] ,
            'message',
            'created_at',
            [
                    'attribute'=>'censored',
                    'value'=> function($data){
                        return !$data->censored ? '<p class="text-success">Активный</p>' : '<p class="text-danger">Заблокировано</p>';
                                    },
                                    'format'=>'raw',
],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
