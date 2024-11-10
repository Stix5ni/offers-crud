<?php


namespace app\controllers;


use app\models\Offer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OfferSearch;
use Yii;
use yii\helpers\Url;


class OfferController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

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
        $model = new Offer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Оффер успешно создан.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при создании оффера.');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Оффер успешно обновлен.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try {
            $model = $this->findModel($id);
            if ($model->delete()) {
                // проверка с какой страницы был запрос
                $referrer = Yii::$app->request->referrer;

                // запрос пришел с страницы 'view' => редиректим на 'index'
                if ($referrer && strpos($referrer, 'view') !== false) {
                    return [
                        'success' => true,
                        'redirectUrl' => Url::to(['index'])
                    ];
                }

                // с 'index' => обновляем Pjax контейнер
                return [
                    'success' => true,
                    'message' => 'Оффер был успешно удален.'
                ];
            }

            return ['success' => false, 'message' => 'Ошибка при удалении оффера'];
        } catch (\Exception $e) {
            Yii::error('Ошибка при удалении оффера: ' . $e->getMessage());
            
            return ['success' => false, 'message' => 'Ошибка при удалении оффера'];
        }
    }


    protected function findModel($id)
    {
        if (($model = Offer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
