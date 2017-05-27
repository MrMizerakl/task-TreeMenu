<?php

namespace app\modules\menu\controllers;

use app\models\Menu;
use yii\web\Controller;

/**
 * Default controller for the `menu` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Menu();
        $items = $model::find()->select('id, name, parent, isgroup')->orderBy('isgroup desc, parent, name')->asArray()->all();
        return $this->render('index', [
            'model' => $items,
        ]);
    }
}
