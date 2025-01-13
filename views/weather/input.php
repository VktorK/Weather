<?php


use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var app\models\Weather $postsJs Сюда она пришла в виде JSON*/
$this->title = 'Создание товара';

try {
    $this->registerJsFile(
        '@web/js/weather-list.js',
        ['depends' => [AppAsset::class]]
    );
} catch (\yii\base\InvalidConfigException $e) {
    var_dump('error list.sj');die();
}

try {
    $this->registerCssFile('@web/css/weather-modal.css', [
        'depends' => [AppAsset::class],
    ]);
} catch (\yii\base\InvalidConfigException $e) {
    var_dump('error weather-modal.css');die();
}

?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="post-form">

        <?php $form = ActiveForm::begin(); ?>
        <!-- Поле ввода для заголовка поста -->
        <?= $form->field($model, 'email')->textInput(['id' => 'input-field', 'placeholder' => 'Введите заголовок поста'])->label('Заголовок') ?>

        <!-- Чекбокс -->
        <label>
            <input type="checkbox" id="toggle-input"> Блокировать поле ввода
        </label>

        <!-- Новое поле ввода для выбора постов -->
        <div id="post-selector" style="display: none; margin-top: 10px;">
            <input type="text" id="post-input" placeholder="Выберите пост...">
            <div id="posts-container" style="margin-top: 10px; display: none;">
            </div>
        </div>

        <!-- Кнопка отправки формы -->
        <div class="form-group">
            <?= Html::submitButton('Создать',
                ['id'=>'submit-button', 'class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<script>
    const posts = <?php echo $postsJs;?>;
</script>