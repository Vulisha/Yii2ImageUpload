<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use backend\models\Images;
use dosamigos\gallery;

/* @var $this yii\web\View */
/* @var $model backend\models\Album */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">
<?= $model->id ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->id == $model->user_id){ 
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);} ?>
        <?php 
            if(Yii::$app->user->id == $model->user_id){
                echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
            } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'user_id',
        ],
    ]) ?>

</div>
<div class="image-view-in-album">
    <?php 
    $user=User::findOne($model->user_id);
    echo $user->username.'<br>';
    $images=Images::find()
        ->where(['like','album_id',$model->id])
        ->andFilterWhere(['deleted'=>0])
        ->all();

    foreach ($images as $image) {
        $i=0;
        $imgLink=Html::img(Yii::getAlias('@web').'/'.$image->path,['width'=>'200','class'=>'imgViewInAlbum']);
        echo Html::a( $imgLink, $url = './index.php?r=image%2Fview&id='.$image->image_id);

    }



    ?>    

</div>
