<?php

namespace backend\controllers;

use Yii;
use backend\models\UserImage;
use backend\models\UserImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserImageController implements the CRUD actions for UserImage model.
 */
class UserImageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserImage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserImage model.
     * @param integer $user_id
     * @param integer $image_id
     * @return mixed
     */
    public function actionView($user_id, $image_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $image_id),
        ]);
    }

    /**
     * Creates a new UserImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserImage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'image_id' => $model->image_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserImage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $image_id
     * @return mixed
     */
    public function actionUpdate($user_id, $image_id)
    {
        $model = $this->findModel($user_id, $image_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'image_id' => $model->image_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $image_id
     * @return mixed
     */
    public function actionDelete($user_id, $image_id)
    {
        $this->findModel($user_id, $image_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $image_id
     * @return UserImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $image_id)
    {
        if (($model = UserImage::findOne(['user_id' => $user_id, 'image_id' => $image_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
