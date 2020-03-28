<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\offer\models\Offer */

$this->title = 'Актуализирай: ' . $model->offer_id;
$this->params['breadcrumbs'][] = ['label' => 'Предложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->offer_id, 'url' => ['view', 'id' => $model->offer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="offer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
