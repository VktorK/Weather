<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Создание ходатайства';
?>

<div class="request-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <!-- Название суда -->
    <?= $form->field($model, 'court_name')->textInput(['maxlength' => true, 'placeholder' => 'Введите название суда'])->label('Название суда') ?>

    <!-- Истец -->
    <?= $form->field($model, 'plaintiff')->textInput(['maxlength' => true, 'placeholder' => 'Введите имя истца'])->label('Истец') ?>

    <!-- Ответчик -->
    <?= $form->field($model, 'defendant')->textInput(['maxlength' => true, 'placeholder' => 'Введите имя ответчика'])->label('Ответчик') ?>

    <!-- Номер дела -->
    <?= $form->field($model, 'case_number')->textInput(['maxlength' => true, 'placeholder' => 'Введите номер дела'])->label('Номер дела') ?>

    <!-- Название организации -->
    <?= $form->field($model, 'organization_name')->textInput(['maxlength' => true, 'placeholder' => 'Введите название организации'])->label('Название организации') ?>

    <!-- Чекбокс: На усмотрение суда -->
    <?= $form->field($model, 'at_discretion')->checkbox()->label('На усмотрение суда') ?>

    <!-- Чекбокс: Запрещенные организации и эксперты -->
    <?= $form->field($model, 'forbidden_entities')->checkbox()->label('Запрещенные организации и эксперты') ?>

    <!-- Поле Title -->
    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Введите заголовок'])->label('Заголовок (Title)') ?>

    <!-- Поле Body -->
    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Введите текст ходатайства'])->label('Текст ходатайства (Body)') ?>

    <!-- Кнопка отправки -->
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
