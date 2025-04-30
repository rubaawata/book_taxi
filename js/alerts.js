function showAlert(message, type='success') {
    $('#' + type + '-alert').html(message);
    $('#' + type + '-alert').addClass('active');
}

function hideAlert(type='success') {
    $('#' + type + '-alert').removeClass('active');
}