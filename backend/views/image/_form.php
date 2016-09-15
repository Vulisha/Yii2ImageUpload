<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Album;

/* @var $this yii\web\View */
/* @var $model backend\models\Images */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="images-form">

    
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    
    <?= $model->isNewRecord? $form->field($model,'file')->fileInput():' '; ?>

    <?= $form->field($model, 'album_id')->dropDownList(
            ArrayHelper::map(Album::findAll(['user_id'=>Yii::$app->user->id]),'id','name'),
                ['prompt'=>'Odaberi album']
    ) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
