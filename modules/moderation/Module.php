<?php

namespace app\modules\moderation;

use Yii;

/**
 * moderation module definition class
 */

class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\moderation\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        return
            Yii::$app->user->isGuest ?
                Yii::$app->response->redirect('/') :
                Yii::$app->user->identity->id_role !== 2 ?
                    Yii::$app->response->redirect('/') : null;
    }
}
