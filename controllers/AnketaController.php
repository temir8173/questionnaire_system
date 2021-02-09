<?php

namespace app\controllers;

use Yii;
use app\models\AnketaCategory;
use app\models\Anketa;
use app\models\HeaderFields;
use app\models\Question;
use app\models\Results;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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
        $anketas = Anketa::find()->where(['category_id' => $category_id])->all();
        $category = AnketaCategory::findOne($category_id);

        return $this->render('index', [
            'anketas' => $anketas,
            'category' => $category,
        ]);
    }

    public function actionView($id)
    {

        $anketa = Anketa::findOne($id);
        $headerfields = HeaderFields::find()->where(['anketa_id' => $anketa->id])->all();
        $questions = Question::find()->where(['anketa_id' => $anketa->id])->with('options.optionitems', 'category')->orderBy(['q_category_id' => SORT_ASC])->all();
        $results = [new Results()];
        for($i = 1; $i < count($questions); $i++) {
            $results[] = new Results();
        }

        $result = ArrayHelper::index($questions, 'q_category_id');
        
        /*echo '<pre>';
        var_dump($result[13]);die;
        echo '</pre>';*/

        return $this->render('view', [
            'anketa' => $anketa,
            'questions' => $questions,
            'headerfields' => $headerfields,
            'results' => $results,
        ]);
    }

    
}
