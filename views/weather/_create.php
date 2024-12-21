<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Weather $weather */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($weather, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'weather_photo')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'check_photo')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'date_bying')->textInput() ?>

    <?= $form->field($weather, 'date_end_warranty')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>