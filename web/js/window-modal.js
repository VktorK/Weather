$(document).ready(function() {
    const modal = $('#weather-modal');
    $('.weather-row').on('click', function() {
        const weatherId = $(this).data('id');
        const weather = weatherData.find(w => w.id === weatherId);
        console.log(weather)


        if (weather) {
            $('#modal-title').text(weather.title);
            $('#modal-price').text(weather.price + ' Р');
            $('#modal-seller').text(weather.seller_id|| 'Не указан продавец');

            const imageUrl = weather.weather_photo
                ? `/uploads/weather_photo/${weather.user_id}/${weather.weather_photo}`
                : '/uploads/no-image.png';
            $('#modal-image').attr('src', imageUrl);

            modal.show();
        }
    });

    $('.close-button').on('click', function() {
        modal.hide();
    });

    $(window).on('click', function(event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });
});