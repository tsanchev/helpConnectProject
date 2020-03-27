<?php

/* @var $this yii\web\View */
/* @var $giver \backend\modules\giver\models\Giver */
/* @var $seekerSearch backend\modules\seeker\models\SeekerSearch */
/* @var $seekerDataProvider yii\data\ActiveDataProvider */

$this->title = 'Предложи помощ';

use yii\helpers\Html;
use yii\widgets\DetailView; ?>
<div class="site-give-help">

    <h1 class="text-center"><?= $this->title ?></h1>

    <?php if( $giver->giver_id == 0): ?>

        <p><b>Твоите данни:</b></p>

        <?= $this->render('@backend/modules/giver/views/default/_form', [
            'model' => $giver,
        ]) ?>

    <?php else: ?>

        <p><b>Моят профил</b></p>

        <?= DetailView::widget([
            'model' => $giver,
            'attributes' => [
                //'giver_id',
                //'user.username',
                'name',
                'phone',
                'company',
                'services:ntext',
            ],
        ]) ?>
        <br>

        <p><b>Списък търсещи помощ</b></p>

        <?= $this->render('_seekerList', [
            'seekerSearch' => $seekerSearch,
            'seekerDataProvider' => $seekerDataProvider,
        ]) ?>

    <?php endif; ?>


</div>
