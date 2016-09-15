<?php

namespace backend\controllers;

use Yii;
use backend\models\Images;
use backend\models\ImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Album;
use yii\web\ForbiddenHttpException;
use yii\base\Security;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;
use yii\db\Expression;
use backend\Models\UserImage;
use yii\filters\AccessControl;
/**
 * ImageController implements the CRUD actions for Images model.
 */
class ImageController extends Controller
{
    public function behaviors()
    {
        return [
             'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
               
            ],
        ];
    }

    /**
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)

    {   
        $model=$this->findModel($id);
        if($model->deleted!=1){
        $userimage=UserImage::findOne(['image_id'=>$model->image_id,'user_id'=>Yii::$app->user->id]);
        if(!$userimage)
        {
            $userimage = new UserImage;
            $userimage->user_id=Yii::$app->user->id;
            $userimage->image_id=$model->image_id;
            $userimage->last_view=time();
            $userimage->save();
            ++$model->counter;
            $model->save();
        }else{
            if((time() - $userimage->last_view)>(24*60*60)){
                ++$model->counter;
                $model->save();
                $userimage->last_view=time();
                $userimage->save();}
        }

        return $this->render('view', [
            'model' => $model,
            ]);
        }
         return $this->redirect(['index']);
    }

    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Images();

        if ($model->load(Yii::$app->request->post())) {
            $imageName = strtr(substr(base64_encode(Security::generateRandomKey(16)), 0, 16), '+/', '_-');
            $model->file = UploadedFile::getInstance($model,'file');
            $model->file->saveAs('uploads/'.$imageName.'.'.$model->file->extension);
            $model->path='uploads/'.$imageName.'.'.$model->file->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->image_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $album=Album::findOne($model->album_id);
        if(Yii::$app->user->id == $album->user_id){

            if ($model->load(Yii::$app->request->post())) {
                $expression = new Expression('NOW()');
                $model->last=$expression;
                $model->save();
                return $this->redirect(['view', 'id' => $model->image_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
    }else {
        throw new ForbiddenHttpException;
    }
        
    }

    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $model = $this->findModel($id);
        $album=Album::findOne($model->album_id);
        if(Yii::$app->user->id == $album->user_id){
            //$this->findModel($id)->delete();
            $model=$this->findModel($id);
            $model->deleted=1;
            $model->save();
            return $this->redirect(['index']);
        }else {
        throw new ForbiddenHttpException;
    }

        
    }

    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
