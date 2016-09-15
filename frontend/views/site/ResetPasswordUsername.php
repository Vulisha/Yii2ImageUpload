<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Request;
use common\models\User;

$this->title = 'Answer question';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to reset password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?php 
                        $user=User::findByUsername(Yii::$app->request->get('username'));
                        echo $user->secret_question;
                        $model->username=Yii::$app->request->get('username');
                ?>


                <?= $form->field($model, 'secret_answer')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Reset', ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
