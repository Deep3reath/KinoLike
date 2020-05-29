<?php

use yii\widgets\ListView;
?>


<?php
/* @var $dataProvider */
/* @var $response */
/* @var $genre \app\models\Genre */


?>
<div class="search__header">
    <h1>Поиск:  &nbsp;<span><?= $response ?></span></h1>
    <p>Фильмов: <?= $filmsCount ?></p>
</div>
<div class="search__results">
    <h4>Результаты поиска: <?= $dataProvider->count ?></h4>
</div>
<hr>
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