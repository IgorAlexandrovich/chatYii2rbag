<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
$this->title = 'Чат';
// $permission есть ли у пользователя роль админ
?>
<div class="panel panel-default">
<?php foreach ($queryMessage as $message): ?><!--  перебираем сообщения-->
<?php foreach ($queryUser as $user): ?><!--перебираем юзеров-->
<?php if($user->id === $message->user_id): ?> <!--проверяем соответствие сообщение юзеру-->

            <div class="panel panel-default">

                <div class="panel-heading"> <?= \yii\helpers\Html::encode($user->username) ?> <?=  \yii\helpers\Html::encode($message->created_at) ?> <!--выводим дату и имя юзера-->
                 </div>
            <?php break?>
            <?php endif; ?>
            <?php endforeach; ?>

                <div class="panel-body">
 <?php if($permission && $message->censored){
     echo '<p class="text-danger">' ;
 }

     ?>
 <?php if($user->username === 'admin'): ?> <!--проверяем если админ показываем синим-->

                   <p class="text-primary"> <b><?=  \yii\helpers\Html::encode($message->message )   ?> </b></p> <br>

                <?php else: ?>

        <?= \yii\helpers\Html::encode($message->message)  ?> <!--если юзер показываем стандартно-->

    <?php endif; ?>
                </div>


    </div>
        <?php endforeach; ?> </div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

<?php $form = ActiveForm::begin([
    'action' => ['/site/message'],
]); ?>

<?= $form->field($model, 'message')->textarea(['rows' => 6])->label('Ваше сообщение') ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить',['class' => 'btn btn-primary']); ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
