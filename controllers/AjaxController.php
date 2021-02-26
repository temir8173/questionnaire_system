<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Program;
use app\models\Teacher;
use app\models\Subject;
use app\models\School;
use app\models\Anketa;
use app\models\HeaderFields;

class AjaxController extends Controller
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

    public function actionSelect($id = 0, $target = null)
    {

        $options = [];
        switch ($target) {
            case 'program':
                $options = Program::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->where(['school_id' => $id])->indexBy('id')->column();
                break;
            case 'teacher':
                $options = Teacher::find()->select(['name', 'id'])->where(['school_id' => $id])->indexBy('id')->column();
                break;
            case 'subject':
                $options = Subject::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->where(['school_id' => $id])->indexBy('id')->column();
                break;
            case 'school':
                $options = School::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->where(['institute_id' => $id])->indexBy('id')->column();
                break;
            case 'anketa':
                $options = Anketa::find()->select([(Yii::$app->language == 'kk') ? 'name_kaz' : 'name_rus', 'id'])->where(['category_id' => $id])->indexBy('id')->column();
                break;
        }

        if ( Yii::$app->request->isAjax ) {
            return $this->renderAjax('select', [
                'options' => $options
            ]);
        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }

    }

    public function actionResultParams($id = 0, $target = null)
    {

        $headerFields = [];
        $headerFields = HeaderFields::find()->where(['anketa_id' => $id])->with('results.question')->all();

        if ( Yii::$app->request->isAjax ) {
            return $this->renderAjax('result-params', [
                'headerFields' => $headerFields
            ]);
        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
    }
    
}
