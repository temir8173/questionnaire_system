<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\AnketaCategory;
use app\models\Results;
use app\models\Anketa;
use app\models\Question;
use app\models\HeaderResults;

class ResultsController extends Controller
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

    public function actionIndex()
    {

        return $this->render('index', []);
    }

    public function actionExport()
    {
        $countedResults = [];
        $headerResults = [];
        $i = 0;

        $resultFilters = Yii::$app->request->post('Result');
        $languages = ( !empty($resultFilters['language']) ) ? [$resultFilters['language']] : ['kk', 'ru'];
        $anketa = Anketa::findOne($resultFilters['anketa_id']);
        if ( !empty($resultFilters['header']) ) {
            foreach ($resultFilters['header'] as $k => $fieldHeader) {
                if ( !empty($fieldHeader['fields']) ) {
                    if ( $fieldHeader['type'] == 'custom' ) {
                        $where = [ 'h.answer_custom' => $fieldHeader['fields'], 'h.header_question_id' => [$k] ];
                    } else {
                        $where = [ 'h.answer_id' => $fieldHeader['fields'], 'h.header_question_id' => [$k] ];
                    }
                    $i++;
                }
                if ( $i > 1 )
                    $where = [ 'h.id' => 0, 'h.header_question_id' => 0 ];
                    
            }
            $results = Results::find()
            ->joinWith('headerResults h')
            ->where(['anketa_id' => $anketa->id])
            ->andWhere($where)
            ->andWhere(['language' => $languages ])
            ->with('resultsItems.question.category', 'resultsItems.optionItem', 'resultsItems.question.options.optionitems')
            ->all();
            if ( !empty($where['h.answer_custom']) ) {
                $headerResults = HeaderResults::find()->where([ 'answer_custom' => $where['h.answer_custom'], 'header_question_id' => $where['h.header_question_id'] ])->all();
            } elseif ( !empty($where['h.answer_id']) ) {
                $headerResults = HeaderResults::find()->where([ 'answer_id' => $where['h.answer_id'], 'header_question_id' => $where['h.header_question_id'] ])->all();
            }
            
        } else {
            $results = Results::find()
            ->joinWith('headerResults h')
            ->where(['anketa_id' => $anketa->id])
            ->andWhere(['language' => ( !empty($resultFilters['language']) ) ? $resultFilters['language'] : ['kk', 'ru'] ])
            ->with('resultsItems.question.category', 'resultsItems.optionItem', 'resultsItems.question.options.optionitems')
            ->all();
        }


        /* Группируем результаты по вопросам и вариантам ответов */
        foreach ($results as $k => $result) {
            foreach ($result->resultsItems as $j => $resultItem) {

                $categoryId = ($resultItem->question->category) ? $resultItem->question->category->id : 0;
                /* Категория */
                if ( empty( $countedResults[$categoryId] ) ) {
                    $countedResults[$categoryId] = [ 
                        'q_category' => $resultItem->question->category,
                        'questions' => []
                    ];
                }
                /* Вопросы */
                if ( empty( $countedResults[$categoryId]['questions'][$resultItem->question_id] ) ) {
                    $countedResults[$categoryId]['questions'][$resultItem->question_id] = [ 
                        'question' => $resultItem->question,
                        'total' => 0,
                        'options' => [],
                    ];
                }
                /* Варианты ответов на вопрос */
                foreach ($resultItem->question->items as $item) {
                    if ( empty( $countedResults[$categoryId]['questions'][$resultItem->question_id]['options'][$item['id']] ) ) {
                        $countedResults[$categoryId]['questions'][$resultItem->question_id]['options'][$item['id']] = [ 
                            'count' => 0,
                            'option' => $item
                        ];
                    }
                }
                $countedResults[$categoryId]['questions'][$resultItem->question_id]['options'][$resultItem->answer_id]['count']++;
                /* Собственные варианты ответа респондента */
                if ( $resultItem->answer_custom !== null ) {
                    $countedResults[$categoryId]['questions'][$resultItem->question_id]['options'][$resultItem->answer_id]['custom_answer'][] = $resultItem->answer_custom;
                }
                /* общее число ответов на данный вопрос (для вычесления доли каждого варианта ответа) */
                $countedResults[$categoryId]['questions'][$resultItem->question_id]['total']++;

            }
        }

        if (count($results) == 0) {
            Yii::$app->session->setFlash('error', Yii::t('common', 'Нәтижелер жоқ'));
            return $this->redirect(['/results/index']);
        } else {
            return $this->renderPartial('export', [ 
                'countedResults' => $countedResults,
                'results' => $results,
                'anketa' => $anketa,
                'headerResults' => $headerResults,
                'languages' => $languages
            ]);
        }
        
    }

    

    
}
