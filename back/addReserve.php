<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

/* AJAX */
require_once 'config.php';
require_once 'constants.php';
// Set the content type to JSON
header('Content-Type: application/json');
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    // Create operation (add a new book)
    $service_type = htmlentities($_POST['service_type']);
    $start_location = htmlentities($_POST['start_location']);
    $end_location = htmlentities($_POST['end_location']);
    $user_name = htmlentities($_POST['user_name']);
    $user_phone = htmlentities($_POST['user_phone']);
    $user_email = htmlentities($_POST['user_email']);
    $user_notes = htmlentities($_POST['user_notes']);
    $date = htmlentities($_POST['date']);
    $fare = htmlentities($_POST['fare']);

    //check if user exist
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->execute([$user_email]);
    $user = $stmt->fetch();
    if (!$user) {
        $stmt = $pdo->prepare('INSERT INTO users (name, phone, email) VALUES (?, ?, ?)');
        $stmt->execute([$user_name, $user_phone, $user_email]);
        $user_id = $pdo->lastInsertId();
    } else {
        $user_id = $user['id'];
    }

    $stmt = $pdo->prepare('INSERT INTO bookings (location_a, location_b, notes, user_id, service_type_id, booking_date, fare, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$start_location, $end_location, $user_notes, $user_id, $service_type, $date, $fare, 'pending']);

    //Sending Email To Admin
    $stmt = $pdo->prepare("SELECT * FROM service_types WHERE id=? LIMIT 1");
    $stmt->execute([$service_type]);
    $service_type_name = $stmt->fetch();

    $service_type_name = $service_type_name['name_en'];

    $message = "New Reserve";
    $message .= "\r\nService Type:  " . $service_type_name;
    $message .= "\r\nStart Location:  " . $start_location;
    $message .= "\r\nEnd Location:  " . $end_location;
    $message .= "\r\nBooking Date:  " . $date;
    $message .= "\r\nFare:  " . $fare . " €";
    $message .= "\r\nUser Name:  " . $user_name;
    $message .= "\r\nUser Phone:  " . $user_phone;
    $message .= "\r\nUser Email:  " . $user_email;
    $message .= "\r\nUser Note:  " . $user_notes;
    mail($admin_email, "New Reserve", $message);

    //Sending Email To User
    $mail = new PHPMailer(true);
    try {
        //Server settings                     //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.transip.email';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'reservation@rtntaxi.nl';                     //SMTP username
        $mail->Password = 'Taxi123456789';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('reservation@rtntaxi.nl', 'Taxi Rotterdam RTN');
        $mail->addAddress($user_email, $user_name);     //Add a recipient
        $mail->addReplyTo('reservation@rtntaxi.nl', 'Taxi Rotterdam RTN');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Taxi Reservation';
        $mail->Body = '
        
        <body class="body" style="width:100%;height:100%;padding:0;Margin:0">
        <div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#F6F6F6"><!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" color="#f6f6f6"></v:fill>
                </v:background>
            <![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#F6F6F6">
            <tr>
            <td valign="top" style="padding:0;Margin:0">
            <table class="es-header" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top">
                <tr>
                <td align="center" style="padding:0;Margin:0">
                <table class="es-header-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr>
                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-right:20px;padding-left:20px"><!--[if mso]><table style="width:560px" cellpadding="0"
                                cellspacing="0"><tr><td style="width:180px" valign="top"><![endif]-->
                    <table class="es-left" cellspacing="0" cellpadding="0" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                        <tr>
                        <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:180px">
                        <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                            <tr>
                            <td align="left" style="padding:0;Margin:0"><h2 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:normal;line-height:19px;color:#333333"><strong>Taxi Rotterdam RTN</strong></h2></td>
                            </tr>
                        </table></td>
                        </tr>
                    </table><!--[if mso]></td><td style="width:20px"></td><td style="width:360px" valign="top"><![endif]-->
                    <table cellspacing="0" cellpadding="0" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                        <tr>
                        <td align="left" style="padding:0;Margin:0;width:360px">
                        <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                            <tr>
                            <td align="right" style="padding:0;Margin:0;font-size:0"><img src="https://eijdjrt.stripocdn.email/content/guids/CABINET_cf689e467d7d0dd41f92fb543dd506fcd49edc97fb18e6adb5204c2502216f5a/images/header_logo.jpg" alt="" width="107" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></td>
                            </tr>
                        </table></td>
                        </tr>
                    </table><!--[if mso]></td></tr></table><![endif]--></td>
                    </tr>
                </table></td>
                </tr>
            </table>
            <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important">
                <tr>
                <td align="center" style="padding:0;Margin:0">
                <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr>
                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-right:20px;padding-left:20px">
                    <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                        <tr>
                        <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                        <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                            <tr>
                            <td align="left" style="padding:0;Margin:0"><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Hey there, ' . $user_name .'! It looks like you recently reserved a new trip. We wanted to thank you for choosing us,</p><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">your reservation info is:</p><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Start Location: ' . $start_location . '</p><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">End Location: ' . $end_location . '</p><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Date: ' . $date . '</p><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Fare: ' . $fare . ' €</p></td>
                            </tr>
                        </table></td>
                        </tr>
                    </table></td>
                    </tr>
                </table></td>
                </tr>
            </table>
            <table class="es-footer" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top">
                <tr>
                <td align="center" style="padding:0;Margin:0">
                <table class="es-footer-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr>
                    <td align="left" style="Margin:0;padding-top:20px;padding-right:20px;padding-left:20px;padding-bottom:20px"><!--[if mso]><table style="width:560px" cellpadding="0" 
                            cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
                    <table class="es-left" cellspacing="0" cellpadding="0" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                        <tr>
                        <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
                        <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                            <tr>
                            <td style="padding:0;Margin:0;display:none" align="center"></td>
                            </tr>
                        </table></td>
                        </tr>
                    </table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
                    <table class="es-right" cellspacing="0" cellpadding="0" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                        <tr>
                        <td align="left" style="padding:0;Margin:0;width:270px">
                        <table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                            <tr>
                            <td style="padding:0;Margin:0;display:none" align="center"></td>
                            </tr>
                        </table></td>
                        </tr>
                    </table><!--[if mso]></td></tr></table><![endif]--></td>
                    </tr>
                </table></td>
                </tr>
            </table></td>
            </tr>
        </table>
        </div>
        </body>
        ';

        $mail->send();
    } catch (Exception $e) {
    }
    //End Sending Email To User

    echo json_encode(['message' => 'Booking added successfully']);
} else {
    // Invalid method
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
