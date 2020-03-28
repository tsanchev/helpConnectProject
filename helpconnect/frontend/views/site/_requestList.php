<?php

use backend\modules\request\models\Request;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $seekerRequestsDataProvider yii\data\ActiveDataProvider */

?>

<?= GridView::widget([
    'dataProvider' => $seekerRequestsDataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'request:ntext',

        [
            'attribute' => 'items',
            'format' => 'raw',
            'value' => function ($model) {
                /* @var $model Request */
                $items = null;

                foreach ($model->requestItems as $item){
                    $items .= Html::tag('span', $item->item, ['class' => 'tag']);
                }
                return $items;
            },
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'contentOptions' => ['class' => 'text-nowrap'],
        ],

    ],
]); ?>



