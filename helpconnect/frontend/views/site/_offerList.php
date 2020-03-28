<?php

use backend\modules\offer\models\Offer;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $giverOffersDataProvider yii\data\ActiveDataProvider */

?>

<?= GridView::widget([
    'dataProvider' => $giverOffersDataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'offer:ntext',

        [
            'attribute' => 'items',
            'format' => 'raw',
            'value' => function ($model) {
                /* @var $model Offer */
                $items = null;

                foreach ($model->offerItems as $item){
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



