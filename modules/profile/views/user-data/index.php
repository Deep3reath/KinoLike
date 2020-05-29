<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\modules\profile\controllers\UserDataController;

$this->title = $title;
?>

<div class="text-center container profile-container profile-wrapper">
<h1 class="profile__header"><?=$this->title ?></h1>
<h3 class="profile__username"><?= Yii::$app->user->identity->username?></h3>
<div class="profile__avatar-container">
    <?= Html::img('/upload/avatars/'.Yii::$app->user->identity->avatar, ['class' => 'avatar']); ?>
</div>
<hr>
</div>

<div class="films-index">
    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{items}<div class='Films-Pagination'>\n{pager}</div>",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('widget',['model' => $model]);
        },
        'itemOptions' => [
            'tag' => false,
        ],

        'pager' => [
            'firstPageLabel' => 'К первой',
            'lastPageLabel' => 'К последней',
            'nextPageLabel' => 'Далее',
            'prevPageLabel' => 'Назад',
            'maxButtonCount' => 3,
        ],
    ]);
    ?>
</div>
