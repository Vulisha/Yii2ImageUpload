<?php
use yii\widgets\Menu;
use yii\grid\GridView;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
    
    <?php 
    //
       
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'users.username',
                'album.name',
                'counter',
                [
                    'attribute' => 'image',
                    'format' => 'html',    
                    'value' => function ($data) {
                        $imgLink= Html::img(Yii::getAlias('@web').'/'. $data['path'],
                            ['width' => '70px']);
                        return Html::a($imgLink, $url = './index.php?r=image%2Fview&id='.$data['image_id']);
                    },
                ],
                                
            ],

        ]);
    ?>


    </div>

    <div class="body-content">



    </div>
</div>
