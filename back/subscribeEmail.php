<?php
/* AJAX */
require_once 'config.php';
require_once 'constants.php';
// Set the content type to JSON
header('Content-Type: application/json');
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST') {
    // Create operation (add a new book)
    $email = htmlentities($_POST['email']);

    //check if user exist
    $stmt = $pdo->prepare("SELECT * FROM subscribers WHERE email=? LIMIT 1"); 
    $stmt->execute([$email]); 
    $subscriber = $stmt->fetch();
    if(!$subscriber) {
        $stmt = $pdo->prepare('INSERT INTO subscribers (email) VALUES (?)');
        $stmt->execute([$email]);
    }

    //Sending Email
    $message= "New Subscriber Email is: " . $email;
    mail($admin_email,"New Subscriber", $message);

    echo json_encode(['message' => 'Email added successfully']);
} else {
    // Invalid method
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
