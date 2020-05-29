<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var $films app\models\Films */
/** @var $users app\models\User */
$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

<?=
GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'text',
            'date',
            [
                'label' => 'Фильм',
                'format' => 'raw',
                'attribute' => 'film.title',
            ],
            [
                'label' => 'Пользователь',
                'format' => 'raw',
                'attribute' => 'user.username',
            ],
            [
                'label' => 'Тип',
                'format' => 'raw',
                'value' => function($data){
                    return $data->review == 1 ? 'Рецензия' : 'Комментарий';
                },
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
