<?php

use yii\helpers\Html;


?>
<div class="text-center container">
    <h2>Добро пожаловать, Модератор</h2>
    <div style="width: 100px; height: 100px; margin: 0 auto; overflow: hidden; border-radius: 50%;">
        <?= Html::img('/upload/avatars/'.Yii::$app->user->identity->avatar, ['style' => 'width: 150px;object-fit: cover;']); ?>
    </div>
    <p>Выберите, что хотите просмотреть</p>
    <div class="row">
        <?= Html::a('Фильмы', '/moderation/films', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Жанры', '/moderation/genres', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Пользователи', '/moderation/users', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Комментарии', '/moderation/comments', ['class' => 'btn btn-primary']); ?>
    </div>
</div>