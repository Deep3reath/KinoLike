<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $genres  */
/* @var $model app\models\Films */

$this->title = 'Добавить фильм';
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="films-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'genres' => $genres
    ]) ?>

</div>