<?php

namespace app\modules\filmPage\controllers;

use app\models\Comments;
use app\models\Films;
use app\models\FilmsSearch;
use app\models\Genre;
use app\models\Genres;
use app\models\GenresSearch;
use app\models\Rating;
use app\models\Viewed;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `filmPage` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $post = Yii::$app->request->post('Genres');
        $query = isset($post) ? Genre::find()->joinWith("film")->where(["id_genres"=>$post['title']])->orderBy('id DESC') : Films::find()->orderBy('id DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
                'totalCount' => FilmsSearch::find()->orderBy('id DESC')->count()
            ],
        ]);
        return $this->render('index', [
            'filmsCount' => Films::find()->count(),
            'recommended' => Films::find()->orderBy('id desc')->limit(5)->all(),
           # 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelGenres' => new Genres(),
        ]);
    }

    public function filmVotes($id)
    {
        $data = Rating::find()->where(['id_film' => $id])->count();
        return $data = null ? '0' : $data;
    }
}
