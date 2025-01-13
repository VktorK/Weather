$(document).ready(function() {
    $('#search-input').on('input', function() {
        var query = $(this).val();
        console.log(query);

        if (query.length > 1) {
            $.ajax({
                url: '/site/search', // Убедитесь, что URL правильный
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#search-results').empty(); // Очищаем предыдущие результаты
                    if (data.length > 0) {
                        $.each(data, function(index, item) {
                            $('#search-results').append('<div>' + item.title + '</div>'); // Предположим, что вы отображаете поле 'email'
                        });
                    } else {
                        $('#search-results').append('<div>Нет результатов</div>');
                    }
                },
                error: function() {
                    $('#search-results').append('<div>Ошибка при выполнении запроса</div>');
                }
            });
        } else {
            $('#search-results').empty(); // Очищаем результаты, если меньше 4 символов
        }
    });

    // $('#search-results').on('click', 'div', function() {
    //     $('#search-input').val($(this).text()); //Заполняем поле выбора поста
    //     $('#search-results').hide(); // Скрываем контейнер с постами
    // });

    $('#search-results').on('click', 'div', function() {
        var value = $(this).data('value');
        var text = $(this).text();
        $('#search-input').val(text);
        $(this).remove();
    });
});