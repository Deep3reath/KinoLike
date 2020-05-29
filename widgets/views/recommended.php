<?php


/* @var $film \app\models\Films */

?>
<?= \yii\helpers\Html::a(\yii\helpers\Html::img('/'.$film->img, ['class' => 'recommended-image', 'title' => $film->title]), '/film-page/film/view?id='.$film->id)?>

