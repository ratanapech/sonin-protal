<?php

namespace app\modules\tool\controllers;

use yii\web\Controller;

/**
 * Default controller for the `tool` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
