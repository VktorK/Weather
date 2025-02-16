<?php


use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/** @var app\models\Weather $postsJs Сюда она пришла в виде JSON*/
/** @var app\models\Weather $weather Сюда она пришла в виде JSON*/
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
$this->registerJs(<<<JS
    $('#example-form').on('beforeSubmit', function (e) {
        e.preventDefault(); // Предотвращаем стандартное поведение формы
        // Делаем кнопку не активной
        $('#submit-button').prop('disabled', true);

        // Отправляем форму через AJAX
        $.ajax({
            url: $(this).attr('action'), // URL для отправки формы
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                // Обработка успешного ответа
                console.log(response);
                // Здесь можно обработать ответ, например, показать сообщение
                // или очистить форму
            },
            error: function () {
                // Обработка ошибки
                alert('Произошла ошибка при отправке формы.');
                // Включаем кнопку снова
                $('#submit-button').prop('disabled', false);
            }
        });
        return false; // предотвращаем стандартное поведение формы
    });
JS);

?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="post-form">

        <?php $form = ActiveForm::begin([
                'id' => 'example-form',
            'method' => 'post',
            'action' => Url::to(['weather/test']),
        ]); ?>
        <!-- Поле ввода для заголовка поста -->
        <?= $form->field($weather, 'title')->textInput(['id' => 'input-field', 'placeholder' => 'Введите заголовок поста'])->label('Заголовок') ?>

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
    </div>
        <div class="post-form">
<!--            --><?php //= $form->field($model, 'email')->textInput(['id' => 'input-field', 'placeholder' => 'Введите заголовок поста'])->label('Заголовок') ?>

        <!-- Кнопка отправки формы -->
<!--        <div class="form-group">-->
<!--            --><?php //= $form->field($weather, 'title')->textInput([
//                'id' => 'search-input', // Уникальный ID для поля ввода
//                'placeholder' => 'Введите более 1 символa...',
//            ])->label('Поиск элементов'); ?>
<!--            <div id="search-results" style="margin-top: 10px;"></div> <!-- Контейнер для отображения результатов поиска -->-->
<!--        </div>-->
            <div class="form-group mt-4">
                <?= Html::submitButton('Create', ['id' => 'submit-button','class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>

        </div>
<script>
    const posts = <?php echo $postsJs;?>;
</script>