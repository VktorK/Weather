$(document).ready(function() {
    // Обработка изменения состояния чекбокса
    $('#toggle-input').change(function() {
        if ($(this).is(':checked')) {
            $('#input-field').prop('disabled', true).val('').attr('placeholder', 'Поле заблокированно');// Блокируем поле ввода и очищаем его
            $('#post-selector').show(); // Показываем селектор постов
        } else {
            $('#input-field').prop('disabled', false).attr('placeholder', 'Введите заголовок поста'); // Разблокируем поле ввода
            $('#post-selector').hide(); // Скрываем селектор постов
            $('#post-input').val(''); // Очищаем поле выбора поста
        }
    });

    // Обработка клика по полю выбора постов
    $('#post-input').click(function() {
        $('#posts-container').empty();// Очищаем предыдущие результаты
        posts.forEach(function(post) {
            $('#posts-container').append('<div data-id="' + post.id + '">' + post.email + '</div>').show();

        });
        $('#submit-button').css('margin-top', '100px');


    });

    //Обработка клика по посту
    $('#posts-container').on('click', 'div', function() {
        $('#post-input').val($(this).text()); //Заполняем поле выбора поста
        $('#posts-container').hide(); // Скрываем контейнер с постами
        $('#submit-button').css('margin-top', '10px');
    });


    // $('#post-input').on('blur', function() {
    //     $('#posts-container').hide(); // Скрываем список
    // });







});