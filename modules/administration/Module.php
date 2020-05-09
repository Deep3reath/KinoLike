<?php

namespace app\modules\administration;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\administration\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        return
            Yii::$app->user->isGuest ?
                Yii::$app->response->redirect('/') :
            Yii::$app->user->identity->id_role !== 1 ?
                Yii::$app->response->redirect('/') : null;
    }
}
