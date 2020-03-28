<?php

/* @var $this yii\web\View */
/* @var $giver \backend\modules\giver\models\Giver */
/* @var $giverOffersDataProvider \yii\data\ActiveDataProvider */
/* @var $offer \backend\modules\offer\models\Offer */

$this->title = 'Предложи помощ';

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
            ],
        ]) ?>
        <br>

        <p><b>Добави предложение</b></p>

        <?= $this->render('@backend/modules/offer/views/default/_form', [
            'model' => $offer,
        ]) ?>

        <p><b>Моите предложения</b></p>
        <?= $this->render('_offerList', [
            'giverOffersDataProvider' => $giverOffersDataProvider,
        ]) ?>


    <?php endif; ?>


</div>
