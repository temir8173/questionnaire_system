<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\HeaderFields;
use app\models\HeaderFieldsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * HeaderFieldsController implements the CRUD actions for HeaderFields model.
 */
class HeaderFieldsController extends Controller
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
     * Lists all HeaderFields models.
     * @return mixed
     */
    public function actionIndex($anketa_id = 0)
    {
        $searchModel = new HeaderFieldsSearch();

        $dataProvider = $searchModel->search([
            $searchModel->formName()=>[
                'anketa_id'=>$anketa_id, 
                'type' => 'custom', 
                'name_rus' => Yii::$app->request->queryParams[$searchModel->formName()]['name_rus'],
                'name_kaz' => Yii::$app->request->queryParams[$searchModel->formName()]['name_kaz'],
            ],
            'sort' => Yii::$app->request->queryParams['sort']
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'anketa_id' => $anketa_id
        ]);
    }

    /**
     * Displays a single HeaderFields model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $anketa_id = 0)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HeaderFields model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($anketa_id = 0)
    {
        $model = new HeaderFields();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['close'])) {
                return $this->redirect(Url::to(['index', 'anketa_id' => $model->anketa_id]));
            }
        }

        return $this->render('create', [
            'model' => $model,
            'anketa_id' => $anketa_id
        ]);
    }

    /**
     * Updates an existing HeaderFields model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['close'])) {
                return $this->redirect(Url::to(['index', 'anketa_id' => $model->anketa_id]));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HeaderFields model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $anketa_id = $model->anketa_id;
        $model->delete();

        return $this->redirect(Url::to(['index', 'anketa_id' => $anketa_id]));
    }

    /**
     * Finds the HeaderFields model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HeaderFields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HeaderFields::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
