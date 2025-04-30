var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var phoneRegex = /^(0)?\d{10}$/;

/*---------------------------------------*/
function openFareModal() {
    //check form value errors
    service_type = $('#service_type').val();
    start_location = $('#start_location').val();
    end_location = $('#end_location').val();
    date = $('#date').val();
    
    errors = 0;
    if (service_type == null || service_type == '') {
        errors++;
        $('#service_type_error').html(jsLabels['service_type_required_validation']);
    }

    if (start_location == '') {
        errors++;
        $('#start_location_error').html(jsLabels['pick_up_location_required_validation']);
    }

    if (end_location == '') {
        errors++;
        $('#end_location_error').html(jsLabels['drop_location_required_validation'])
    }

    if (date == '') {
        errors++;
        $('#date_error').html(jsLabels['date_required_validation'])
    }

    if (errors > 0)
        return

    $('#service_type_error').html('');
    $('#start_location_error').html('');
    $('#end_location_error').html('');

    //end

    //calc fare
    $.ajax({
        url: "back/calcFare.php",
        data: {
            'service_type': service_type,
            'location_a': start_location,
            'location_b': end_location
        },
        success: function (result) {
            $("#fare_value").html(result);
        }
    });
    //end

    $('#reservation_modal').modal();
}

function addReserve() {

    //check form value errors
    service_type = $('#service_type').val();
    start_location = $('#start_location').val();
    end_location = $('#end_location').val();
    user_name = $('#user_name').val();
    user_phone = $('#user_phone').val();
    user_email = $('#user_email').val();
    user_notes = $('#user_notes').val();
    date = $('#date').val();
    fare = $('#fare_value').html();

    errors = 0;

    if (user_name == '') {
        errors++;
        $('#user_name_error').html(jsLabels['your_name_required_validation'])
    }

    if (user_phone == '') {
        errors++;
        $('#user_phone_error').html(jsLabels['your_phone_number_required_validation'])
    } else {
        if(!phoneRegex.test(user_phone)) {
            errors++;
            $('#user_phone_error').html(jsLabels['phone_number_regex_validation']);
        }
    }

    if (user_email == '') {
        errors++;
        $('#user_email_error').html(jsLabels['your_email_required_validation']); 

    } else {
        if(!emailRegex.test(user_email)) {
            errors++;
            $('#user_email_error').html(jsLabels['phone_email_regex_validation']);
        }
    }

    if (errors > 0)
        return;
    //end
    
    $('#user_name_error').html('');
    $('#user_phone_error').html('');
    $('#user_email_error').html('');

    //add reserve
    $('#pay_button').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>')
    $.ajax({
        url: "back/addReserve.php",
        type: 'POST',
        data: {
            'service_type': service_type,
            'start_location': start_location,
            'end_location': end_location,
            'user_name': user_name,
            'user_phone': user_phone,
            'user_email': user_email,
            'user_notes': user_notes,
            'date': date,
            'fare': fare
        },
        success: function (result) {
            $('#pay_button').html(jsLabels['pay']);
            showAlert(jsLabels['add_reservation_success'], 'success');
            setTimeout(function () {
                hideAlert('success');
            }, 10000);
            $('#reservation_modal').modal('hide');
            resetReservationForm();
        },
        error: function (result) {
            $('#pay_button').html(jsLabels['pay']);
            showAlert(jsLabels['back_error'], 'error');
            setTimeout(function () {
                hideAlert('error');
            }, 10000);
        }
    });
    //end
}

function resetReservationForm() {
    $('#service_type').val('');
    $('#start_location').val('');
    $('#end_location').val('');
    $('#user_name').val('');
    $('#user_phone').val('');
    $('#user_email').val('');
    $('#user_notes').val('');
    $('#date').val('');
}

/*---------------------------------------*/
function addMessage() {
    //check form value errors
    message_name = $('#message_name').val();
    message_phone = $('#message_phone').val();
    message_message = $('#message_message').val();
    errors = 0;

    if (message_name == '') {
        errors++;
        $('#message_name_error').html(jsLabels['name_required_validation']);
    }

    if (message_phone == '') {
        errors++;
        $('#message_phone_error').html(jsLabels['phone_number_required_validation']);
    } else {
        if(!phoneRegex.test(message_phone)) {
            errors++;
            $('#message_phone_error').html(jsLabels['phone_number_regex_validation']);
        }
    }

    if (message_message == '') {
        errors++;
        $('#message_message_error').html(jsLabels['message_required_validation']);
    }

    if (errors > 0)
        return;

    $('#message_name_error').html('');
    $('#message_phone_error').html('');
    $('#message_message_error').html('');

    $('#send_button').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>')
    $.ajax({
        url: "back/addMessage.php",
        type: 'POST',
        data: {
            'name': message_name,
            'phone': message_phone,
            'message': message_message
        },
        success: function (result) {
            $('#send_button').html('Send');
            showAlert(jsLabels['add_message_success'], 'success');
            setTimeout(function () {
                hideAlert('success');
            }, 10000);
            $('#message_name').val('');
            $('#message_phone').val('');
            $('#message_message').val('');
        },
        error: function (result) {
            $('#send_button').html('Pay');
            showAlert(jsLabels['back_error'], 'error');
            setTimeout(function () {
                hideAlert('error');
            }, 10000);
        }
    });
    //end

    /*---------------------------------------*/
    //end
}

/*---------------------------------------*/
function addSubscriber() {
    //check form value errors
    subscriber_email = $('#subscriber_email').val();
    errors = 0;

    if (subscriber_email == '') {
        errors++;
        $('#subscriber_email_error').html(jsLabels['your_email_required_validation']);
    } else {
        if(!emailRegex.test(subscriber_email)) {
            errors++;
            $('#subscriber_email_error').html(jsLabels['phone_email_regex_validation']);
        }
    }

    if (errors > 0)
        return;

    $('#subscriber_email_error').html('');

    $('#add_subscriber_button').addClass('loading');
    $('#add_subscriber_button').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
    
    $.ajax({
        url: "back/subscribeEmail.php",
        type: 'POST',
        data: {
            'email': subscriber_email
        },
        success: function (result) {
            $('#add_subscriber_button').html('');
            $('#add_subscriber_button').removeClass('loading');
            showAlert(jsLabels['add_subscriber_success'], 'success');
            setTimeout(function () {
                hideAlert('success');
            }, 10000);
            $('#subscriber_email').val('');
        },
        error: function (result) {
            $('#add_subscriber_button').html('');
            $('#add_subscriber_button').removeClass('loading');
            showAlert(jsLabels['back_error'], 'error');
            setTimeout(function () {
                hideAlert('error');
            }, 10000);
        }
    });
    //end

    /*---------------------------------------*/
    //end
}