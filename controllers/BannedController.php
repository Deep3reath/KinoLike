<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class BannedController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('banned', [
        ]);
    }
}
