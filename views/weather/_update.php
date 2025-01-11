<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Weather $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weather_photo')->fileInput() ?>

    <?= $form->field($model, 'check_photo')->fileInput() ?>

    <?= $form->field($model, 'date_bying')->input('date') ?>


    <div class="form-group mt-4">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>