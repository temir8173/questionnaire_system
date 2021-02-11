<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Question;
use app\models\QCategory;
use app\models\Options;
use app\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex($anketa_id = 0)
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search([
            $searchModel->formName()=>[
                'anketa_id'=>$anketa_id, 
                'name_rus' => Yii::$app->request->queryParams[$searchModel->formName()]['name_rus'],
                'name_kaz' => Yii::$app->request->queryParams[$searchModel->formName()]['name_kaz'],
                'q_category_id' => Yii::$app->request->queryParams[$searchModel->formName()]['q_category_id'],
            ],
            'sort' => Yii::$app->request->queryParams['sort']
        ]);
        $qcategories = [];
        $qcategories = QCategory::find()->where(['anketa_id' => $anketa_id])->select(['name_rus', 'id'])->indexBy('id')->column();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'qcategories' => $qcategories,
            'anketa_id' => $anketa_id,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($anketa_id = 0)
    {
        $model = new Question();
        $options = [];
        $options = Options::find()->where(['anketa_id' => $anketa_id])->orWhere(['anketa_id' => 0])->select(['name', 'id'])->indexBy('id')->column();
        $qcategories = [];
        $qcategories = QCategory::find()->where(['anketa_id' => $anketa_id])->select(['name_rus', 'id'])->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['index', 'anketa_id' => $model->anketa_id]));
        }

        return $this->render('create', [
            'model' => $model,
            'options' => $options,
            'qcategories' => $qcategories,
            'anketa_id' => $anketa_id,
        ]);
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $options = Options::find()->where(['anketa_id' => $model->anketa_id])->orWhere(['anketa_id' => 0])->select(['name', 'id'])->orderBy(['anketa_id' => SORT_ASC])->indexBy('id')->column();
        $qcategories = [];
        $qcategories = QCategory::find()->where(['anketa_id' => $model->anketa_id])->select(['name_rus', 'id'])->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->request->post()['close'])) {
                return $this->redirect(Url::to(['index', 'anketa_id' => $model->anketa_id]));
            }
        }

        return $this->render('update', [
            'model' => $model,
            'options' => $options,
            'qcategories' => $qcategories
        ]);
    }

    /**
     * Deletes an existing Question model.
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
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
