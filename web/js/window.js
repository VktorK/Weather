$(document).ready(function() {

    const modal = $('#weather-modal');
    console.log(weatherData)
    $('.weather-row').on('click', function() {
        const weatherId = $(this).data('id');
        const weather = weatherData.find(w => w.id === weatherId);


        if (weather) {
            $('#modal-title').text(weather.title);
            $('#modal-price').text(weather.price + ' Р');
            $('#modal-seller').text(weather.seller || 'Нет описания');

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