<?php


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\widgets\RecommendedWidget;

/* @var $this yii\web\View */
/* @var $filmsCount */
/* @var $recommended */
/* @var $searchModel app\models\FilmsSearch */
/* @var $modelGenres app\models\Genres */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Главная';
?>

<div class="main__header-container">
    <div class="main__top-bar">
        <div class="main__top-bar_headers">
            <h1>Фильмы</h1>
            <p>Фильмов: <?= $filmsCount ?></p>
        </div>
        <div class="main__top-bar_recommended">
            <h2>Рекомендуем  &nbsp;<?= Html::img('/assets/site/danger.svg') ?></h2>
            <div class="main__recommended-image-wrapper">
            <?= RecommendedWidget::widget(['films' => $recommended]); ?>
            </div>
        </div>
    </div>
    <div class="main__sort-container">
        <?php
        $form = ActiveForm::begin();
        echo $form->field($modelGenres, 'title')
            ->dropDownList(ArrayHelper::map($modelGenres->find()->all(),'id','title'), ['class' => 'main__genre-choose'])
            ->label('Жанр', ['class' => false]);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-like']) ?>
            <?php if(Yii::$app->request->post('Genres')): ?>
            <a href="/film-page" class="btn btn-like">Сброс</a>
            <?php endif; ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>
</div>
<?php

$this->title = 'Фильмы';
?>
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
