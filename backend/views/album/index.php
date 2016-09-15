<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Album', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   <?php Pjax::begin();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute'=>'user_id',
                'value'=>'user.username',
            ],
            [
                'attribute'=>'Broj slika',
                'value'=>function ($data){
                    $counter=0;
                    foreach ($data->images as $image) {
                        if($image->deleted==0){
                            $counter++;
                        }
                    }
                    return $counter;
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => [
            //view button
                'view' => function ($url, $model) {
                     return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('yii', 'View'),

                                ]);
                    },
                'update' => function ($url,$model) {
                        return Yii::$app->user->id == $model->user_id ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),]):' ';

                            
                    },
                'delete' => function ($url,$model) {
                        return Yii::$app->user->id == $model->user_id ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),]):' ';
                    },                    


                ]
            ],//!
        ],
    ]); ?>
       <?php Pjax::end();?>

</div>
