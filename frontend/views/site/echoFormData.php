<?php
use yii\helpers\Html;
use yii\base\Security;
?>
Name: 
<?= $model->name?>
<br>Email: 
<?= $model->email?>
<br>Password: 
<?= $model->password?>

<?php echo 'validate: ';
 if(Yii::$app->security->validatePassword('lalala',$model->password)){
 	echo 'true';

 }else{
 	echo 'false';
 }
 ?>