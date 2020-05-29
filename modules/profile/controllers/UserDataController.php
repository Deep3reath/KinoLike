<?php

namespace app\modules\profile\controllers;

use app\models\Favorites;
use app\models\Genre;
use app\models\Genres;
use app\models\Rating;
use app\models\Viewed;
use Yii;
use app\models\Films;
use app\models\FilmsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserDataController implements the CRUD actions for Films model.
 */
class UserDataController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Films models.
     * @return mixed
     */

    public function actionViewed()
    {
        $query = Viewed::find()->joinWith("film")->where(["id_user"=>Yii::$app->user->getId()])->orderBy('id DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
                'totalCount' => FilmsSearch::find()->orderBy('id DESC')->count()
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'title' => 'Просмотренное'
        ]);
    }


    public function actionFavorites()
    {
        $query = Favorites::find()->joinWith("film")->where(["id_user"=>Yii::$app->user->getId()])->orderBy('id DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
                'totalCount' => FilmsSearch::find()->orderBy('id DESC')->count()
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'title' => 'Избранное'
        ]);
    }

    /**
     * Finds the Films model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Films the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Films::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function init()
    {
        if(Yii::$app->user->identity->id_role == 5) $this->redirect('/banned');
    }
}
