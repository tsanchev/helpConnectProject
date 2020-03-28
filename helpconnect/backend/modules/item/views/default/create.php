<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\item\models\Item */

$this->title = 'Създай';
$this->params['breadcrumbs'][] = ['label' => 'Артикули', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
