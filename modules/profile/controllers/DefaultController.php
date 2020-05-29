<?php

namespace app\modules\profile\controllers;

use app\models\Comments;
use app\models\Favorites;
use app\models\Films;
use app\models\Genre;
use app\models\Genres;
use app\models\Rating;
use app\models\User;
use app\models\Viewed;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $lastViewed = Viewed::find()->where(['id_user' => \Yii::$app->user->identity->getId()])->orderBy('id desc')->one();
        $filmViewed = $lastViewed == null ? null : Films::find()->where(['id' => $lastViewed->id_film])->one();

        $lastFavorites = Favorites::find()->where(['id_user' => \Yii::$app->user->identity->getId()])->orderBy('id desc')->one();
        $filmFavorites = $lastFavorites == null? null : Films::find()->where(['id' => $lastFavorites->id_film])->one();

        return $this->render('index',
            [
                'user' => new User,
                'comments' => new Comments,
                'favorites' => new Favorites,
                'viewed' => new Viewed,
                'commentsCount' => Comments::find()->where(['id_user'=>\Yii::$app->user->identity->getId()])->count(),
                'favoritesCount' => Favorites::find()->where(['id_user'=>\Yii::$app->user->identity->getId()])->count(),
                'reviewCount' => Comments::find()->where(['id_user'=>\Yii::$app->user->identity->getId(), 'review'=> 1])->count(),
                'viewedCount' => Viewed::find()->where(['id_user'=>\Yii::$app->user->identity->getId()])->count(),
                'filmRatingCount' => function($id) {return Rating::find()->where(['id_film'=>$id])->count();},
                'filmFavorites' => $filmFavorites,
                'filmViewed' => $filmViewed,
                'genresView' => $genresView = function ($id) { return Genres::getGenresFilm($id); }
            ]);
    }

    public function init()
    {
        if(Yii::$app->user->identity->id_role == 5) $this->redirect('/banned');
    }
}
