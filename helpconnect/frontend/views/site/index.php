<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;

use yii\helpers\Html; ?>
<div class="site-index">

    <h1 class="text-center"><?= $this->title ?></h1>

    <br>
    <?php if (Yii::$app->user->isGuest): ?>
    <div class="alert alert-primary" role="alert">
        <?= Html::a('Създай', ['signup'], ['class' => 'alert-link']) ?> си акаунт или <?= Html::a('влез', ['login'], ['class' => 'alert-link']) ?> в системата за да предоложиш или потърсиш помощ.
    </div>
    <?php else:?>

    <div class="row">
        <div class="col-md-6 text-center">
            <?= Html::a('Потърси помощ', ['site/seek-help'], ['class' => 'btn btn-lg btn-block btn-primary']) ?>
        </div>
        <div class="col-md-6 text-center">
            <?= Html::a('Предложи помощ', ['site/give-help'], ['class' => 'btn btn-lg btn-block btn-primary']) ?>
        </div>
    </div>

    <?php endif; ?>

</div>
