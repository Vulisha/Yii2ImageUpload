<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Album;
use yii\base\Security;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Images */

$this->title = $model->image_id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="images-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <?php 
       $album=Album::findOne($model->album_id);
            if(Yii::$app->user->id == $album->user_id){
                echo Html::a('Update', ['update', 'id' => $model->image_id], ['class' => 'btn btn-primary']);} ?>
       <?php 
            if(Yii::$app->user->id == $album->user_id){ 
            echo Html::a('Delete', ['delete', 'id' => $model->image_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);} ?>
    </p>

    <?= Html::img(Yii::getAlias('@web').'/'.$model->path,['class'=>'imgView']);?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'image_id',
            'path:ntext',
            'counter',
            'created',
            'last',
            'deleted',
            'album_id',
        ],
    ]) ?>

</div>
