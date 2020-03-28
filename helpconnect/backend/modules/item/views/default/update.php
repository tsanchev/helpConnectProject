<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\item\models\Item */

$this->title = 'Актуализирай: ' . $model->item;
$this->params['breadcrumbs'][] = ['label' => 'Артикули', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item, 'url' => ['view', 'id' => $model->item]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
