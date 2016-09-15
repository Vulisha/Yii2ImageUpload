<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\ActiveRecord;
?>

<?php
if(Yii::$app->session->hasFlash('success')){
	echo Yii::$app->session->getFlash('success');

}

 $form = ActiveForm::begin()?>

<?php echo $form->field($model,'name')?>
<?php echo $form->field($model,'email')?>
<?php echo $form->field($model,'password')->passwordInput()?>
<?php echo Html::submitButton('Submit',['class'=>'btn btn-success'])?>