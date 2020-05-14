<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FilmsSearch */
/* @var $genres app\models\Genres */
/* @var $genre app\models\Genre */
/* @var $films app\models\Films */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фильмы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="films-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            'description:ntext',
            'date',
            'country:ntext',
            'operator:ntext',
            'screenwriter:ntext',
            'producer:ntext',
//            [
//                'label' => 'Жанры',
//                'attribute' => 'genres.genres.title',
//                'value' => function ($data) use ($genre, $genres) {
//                    $filmGenres = array();
//                    foreach ($genre->find()->where("id_film = {$data->id}")->all() as $val) {
//                        foreach ($genres->find()->where("id = {$val['id_genres']}")->all() as $line):
//                            array_push($filmGenres, $line->title);
//                        endforeach;
//                    }
//                    return implode(', ', $filmGenres);
//                }
//            ],
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Действия']
        ],
    ]); ?>


</div>
