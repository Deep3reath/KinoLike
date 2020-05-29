<?php
/* @var $model \app\models\Films */
/* @var $genre \app\models\Genre */


?>


<div class="widget__film-container">
    <a href="film-page/film/view?id=<?=$model->film->id?>"><?= \yii\helpers\Html::img('/'. $model->film->img, ['class'=>'recommended-image']) ?></a>
    <div class="widget__film-information">
        <h4><?= $model->film->title ?></h4>
        <div class="film-information-inline-text">
            <p>Дата премьеры: <?= $model->film->date ?></p>
            <p>Проголосовало: <?= \app\modules\filmPage\controllers\DefaultController::filmVotes($model->film->id); ?></p>
        </div>
        <div class="film-information-inline-genres">
            <?php
            foreach($model->film->getGenres()->all() as $genres) {
                echo "<div class='genre'><p>{$genres->genres->title}</p></div>";
            }
            ?>
        </div>
    </div>
    <form action="/film-page/film/view">
        <input type="hidden" name="id" value="<?=$model->film->id?>">
        <input type="submit" class="btn btn-like btn-widget-film" value="Перейти к фильму">
    </form>
</div>

