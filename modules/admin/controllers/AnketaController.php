<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Anketa;
use app\models\AnketaCategory;
use app\models\AnketaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


class AnketaController extends Controller
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
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
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new AnketaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Anketa();
        $categories = [];
        $categories = AnketaCategory::find()->select(['name_rus', 'id'])->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['close'])) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = [];
        $categories = AnketaCategory::find()->select(['name_rus', 'id'])->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['close'])) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionCreateHeaderField()
    {
        $model = new HeaderFields();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Anketa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
