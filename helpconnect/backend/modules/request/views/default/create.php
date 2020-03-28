<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\request\models\Request */

$this->title = 'Създай';
$this->params['breadcrumbs'][] = ['label' => 'Запитвания', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
