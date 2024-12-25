<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Weather $weather */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($weather, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'weather_photo')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'check_photo')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($weather, 'date_bying')->input('date') ?>

<!--        --><?php //echo '<label class="form-label">End Warranty</label>';
//            echo DatePicker::widget([
//                'name' => 'date_bying',
//                'type' => DatePicker::TYPE_COMPONENT_APPEND,
//                'pluginOptions' => [
//                    'format' => 'dd-mm-yyyy',
//                    'autoclose' => true,
//            ]
//        ]); ?>

    <div class="form-group mt-4">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>