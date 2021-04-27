<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\AnketaCategory;
use app\models\Anketa;
use app\models\HeaderFields;
use app\models\Question;
use app\models\Results;
use app\models\ResultItems;
use app\models\HeaderResults;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class AnketaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'about'],
                'rules' => [
                    [
                        'actions' => ['logout', 'about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionCategories()
    {

        $categories = AnketaCategory::find()->select(['name_kaz', 'name_rus', 'id'])->all();

        return $this->render('categories', [
            'categories' => $categories
        ]);
    }

    public function actionIndex($category_id)
    {
        $anketas = [];
        $anketas = Anketa::find()->where(['category_id' => $category_id])->andWhere(['status' => 1])->all();
        $category = AnketaCategory::findOne($category_id);

        return $this->render('index', [
            'anketas' => $anketas,
            'category' => $category,
        ]);
    }

    public function actionView($id)
    {

        $anketa = Anketa::find()->where(['id' => $id])->andWhere(['status' => 1])->one();
        if ( $anketa === null ) {
            throw new \yii\web\HttpException(404,'Бет табылған жоқ');
        }
        /* Вопросы о респонденте (в шапке) */
        $headerFields = HeaderFields::find()->where(['anketa_id' => $anketa->id])->all();
        /* Непосредственно вопросы анкеты */
        $questions = Question::find()->where(['anketa_id' => $anketa->id])->with('options.optionitems', 'category')->orderBy(['q_category_id' => SORT_ASC])->all();
        /* Создаем массив моделей для вопросов анкеты */
        $resultItems = [new ResultItems()];
        for($i = 1; $i < count($questions); $i++) {
            $resultItems[] = new ResultItems();
        }
        /* Создаем маасив моделей для вопросов в шапке */
        $headerResults = [new HeaderResults()];
        for($i = 1; $i < count($headerFields); $i++) {
            $headerResults[] = new HeaderResults();
        }

        /* Перегруппируем вопросы по категориям */
        $questions = Question::GrouppedQuestions($questions);
        $result = new Results();

        /* Сохраняем в БД если получили ajax запрос */
        if ( Yii::$app->request->isAjax ) {

            $return = [
                'error' => 1,
                'message' => 'Ошибка формата данных',
                'redirect' => '/',
            ];

            if ( $result->load(Yii::$app->request->post()) ) {
                $result->save();
            }
            if (Model::loadMultiple($headerResults, Yii::$app->request->post()) && Model::loadMultiple($resultItems, Yii::$app->request->post())) {
                /* Сохраняем ответы из шапки */
                foreach ($headerResults as $headerResult) {
                    $headerResult->result_id = $result->id;
                    $headerResult->save();
                }
                /* сохраняем ответы на непосредственно вопросы */
                foreach ($resultItems as $resultItem) {
                    /* если множественный выбор */
                    if ( is_array($resultItem->answer_id) ) {
                        foreach ($resultItem->answer_id as $key => $answer) {
                            $multipleResultItem = new ResultItems();
                            $multipleResultItem->result_id = $result->id;
                            $multipleResultItem->question_id = $resultItem->question_id;
                            /* если свой ответ респондента ( для различения айдишники приходят в отрицательных значениях ) */
                            if ($answer < 0) {
                                $multipleResultItem->answer_id = -$answer;
                                $multipleResultItem->answer_custom = $resultItem->answer_custom;
                            } else
                                $multipleResultItem->answer_id = $answer;                        
                            $multipleResultItem->save();
                        }
                    } else {
                        $resultItem->result_id = $result->id;
                        /* если свой ответ респондента ( для различения айдишники приходят в отрицательных значениях ) */
                        if ($resultItem->answer_id > 0) 
                            $resultItem->answer_custom = null;
                        elseif ($resultItem->answer_id < 0)
                            $resultItem->answer_id = -$resultItem->answer_id;
                        $resultItem->save();
                    }
                }
                $return['error'] = 0;
                $return['message'] = 'Данные успешно сохранены';
            }
            echo Json::encode($return); die;
        }

        return $this->render('view', compact('anketa', 'questions', 'headerFields', 'result', 'resultItems', 'headerResults'));
    }

    
}
