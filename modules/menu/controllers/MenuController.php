<?php

namespace app\modules\menu\controllers;

use Yii;
use app\models\Menu;
use app\models\Search\MenuSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Url::to(['/site/error']));
        }

        $model = new Menu();

        if ( $model->load( Yii::$app->request->post() ) ) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            if( $model->save() ){
                return ['success' => 'formSave'];
            }
            return ActiveForm::validate($model);

        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Url::to(['/site/error']));
        }

        $model = $this->findModel($id);

        if ( $model->load( Yii::$app->request->post() ) ) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            if( $model->save() ){
                return ['success' => 'formSave'];
            }
            return ActiveForm::validate($model);

        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Url::to(['/site/error']));
        }

        $this->deleteChild($id);
        $this->findModel($id)->delete();
        return true; // $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function deleteChild($id)
    {
        $arr = Menu::find()->select('id')->where(['parent'=>$id])->asArray()->all();
        if( count($arr) ){
            foreach ($arr as $value) {
                $this->deleteChild($value['id']);
            }
        }
        Menu::deleteAll(['parent'=>$id]);
    }

}
