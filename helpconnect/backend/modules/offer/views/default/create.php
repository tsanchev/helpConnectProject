<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\offer\models\Offer */

$this->title = 'Създай';
$this->params['breadcrumbs'][] = ['label' => 'Предложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
