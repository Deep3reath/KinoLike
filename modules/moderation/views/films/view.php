<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Films */
/* @var $genres app\models\Genres */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="films-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы хотите удалить фильм?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php ($data = $model->getGenres()->all()) ?>
    <?php $filmGenres = array(); ?>

    <?php foreach ($data as $val) {
         foreach ($genres->find()->where("id = {$val->id_genres}")->all() as $line)
             array_push($filmGenres, $line->title);
    } ?>
    <?= DetailView::widget([
        "model" => $model,
        'attributes' => [
            [
                'label' => 'Аватар',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img(('@web/' . $data->img), [
                        'alt' => $data->img,
                        'style' => 'width:150px;'
                    ]);
                },
            ],
            'title:ntext',
            [
                'label' => 'Жанры',
                'value' => implode(', ', $filmGenres),
            ],
            'description:ntext',
            'date',
            'country:ntext',
            'operator:ntext',
            'screenwriter:ntext',
            'producer:ntext',
        ],
    ]) ?>

</div>
