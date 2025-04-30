<?php
/* Get Data To Use It In Index Page */
require_once 'config.php';

/******************** Get Service Types ********************/
$stmt = $pdo->query('SELECT * FROM service_types');
$service_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
