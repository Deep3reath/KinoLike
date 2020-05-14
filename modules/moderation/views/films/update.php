<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Films */
/* @var $genres app\models\Genres */

$this->title = 'Изменить фильм: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="films-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'genres' => $genres
    ]) ?>

</div>
