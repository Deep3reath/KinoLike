<?php

use yii\helpers\Html;


?>
<div class="text-center container">
    <h2>Добро пожаловать, Администратор</h2>
    <div style="width: 100px; height: 100px; margin: 0 auto; overflow: hidden; border-radius: 50%;">
    <?= Html::img('@'.Yii::$app->user->identity->avatar, ['style' => 'width: 150px;object-fit: cover;']); ?>
    </div>
    <p>Выберите, что хотите просмотреть</p>
<div class="row">
        <?= Html::a('Фильмы', '/administration/films', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Жанры', '/administration/genres', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Пользователи', '/administration/users', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Комментарии', '/administration/comments', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Роли', '/administration/roles', ['class' => 'btn btn-primary']); ?>
</div>
</div>