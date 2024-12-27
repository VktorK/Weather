<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Weather $model */
/** @var app\models\CheckPhotoImage $check_photo */
/** @var app\models\WeatherPhotoImage $weather_photo */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($weather_photo, 'weather_photo')->fileInput() ?>

    <?= $form->field($check_photo, 'check_photo')->fileInput() ?>

    <?= $form->field($model, 'date_bying')->input('date') ?>


    <div class="form-group mt-4">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>