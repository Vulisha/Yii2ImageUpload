<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Album;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin();?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'album_id',
                'value'=>'album.name',
            ],

            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    $imgLink= Html::img(Yii::getAlias('@web').'/'. $data['path'],
                        ['width' => '70px']);
                    return Html::a($imgLink, $url = './index.php?r=image%2Fview&id='.$data['image_id']);
                },
            ],
            'path:ntext',
            'counter',

            //'created',
            //'last',
            // 'deleted',

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
                    $album=Album::findOne($model->album_id);
                        return Yii::$app->user->id == $album->user_id ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),]):' ';

                            
                    },
                'delete' => function ($url,$model) {
                    $album=Album::findOne($model->album_id);
                        return Yii::$app->user->id == $album->user_id ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),]):' ';
                    },                    


                ]
            ],
        ],
    ]); ?>
        <?php Pjax::end();?>

</div>
