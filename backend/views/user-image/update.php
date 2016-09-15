<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserImage */

$this->title = 'Update User Image: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'image_id' => $model->image_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
