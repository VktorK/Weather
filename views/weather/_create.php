<?php


use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Weather $model */
/** @var app\models\Seller $seller */
/** @var app\models\CheckPhotoImage $check_photo */
/** @var app\models\WeatherPhotoImage $weather_photo */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seller_id')->widget(Select2::class, [
        'options' => [
            'placeholder' => 'Выберите элементы...',
            'class' => 'cd-fid-region',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'ajax' => [
                'url' => Url::to(['seller/search-sellers']), //
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q: params.term}; }'),
                'processResults' => new JsExpression('function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.ID,
                            text: item.TITLE
                        }
                    })
                };
            }'),
            ],
        ],
    ])->label('Поиск элементов'); ?>


    <?= $form->field($weather_photo, 'weather_photo')->fileInput() ?>

    <?= $form->field($check_photo, 'check_photo')->fileInput() ?>

    <?= $form->field($model, 'date_bying')->input('date') ?>


    <div class="form-group mt-4">
        <?= Html::submitButton('Create', ['id'=>'submit-button','class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>