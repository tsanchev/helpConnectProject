<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\seeker\models\Seeker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seeker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'workplace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'necessities')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Запази', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
