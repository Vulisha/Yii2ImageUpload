<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'image_id',
            'last_view',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
