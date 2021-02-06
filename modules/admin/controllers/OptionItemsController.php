<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\OptionItems;
use app\models\OptionItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * OptionItemsController implements the CRUD actions for OptionItems model.
 */
class OptionItemsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        //'controllers' => ['default'],
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ]
        ];
    }

    /**
     * Lists all OptionItems models.
     * @return mixed
     */
    public function actionIndex($option_id = 0)
    {
        $searchModel = new OptionItemsSearch();
        $dataProvider = $searchModel->search([
            $searchModel->formName()=>[
                'option_id'=>$option_id,
                'name_rus' => Yii::$app->request->queryParams[$searchModel->formName()]['name_rus'],
                'name_kaz' => Yii::$app->request->queryParams[$searchModel->formName()]['name_kaz'],
            ],
            'sort' => Yii::$app->request->queryParams['sort']
        ]);
        $model = new OptionItems();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'option_id' => $option_id,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single OptionItems model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OptionItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($option_id = 0)
    {
        $model = new OptionItems();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['close'])) {
                return $this->redirect(Url::to(['index', 'option_id' => $model->option_id]));
            }
        }

        return $this->render('create', [
            'model' => $model,
            'option_id' => $option_id,
        ]);
    }

    /**
     * Updates an existing OptionItems model.
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
                return $this->redirect(Url::to(['index', 'option_id' => $model->option_id]));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OptionItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $option_id = $model->option_id;
        $model->delete();

        return $this->redirect(['index', 'option_id' => $option_id]);
    }

    /**
     * Finds the OptionItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OptionItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OptionItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
