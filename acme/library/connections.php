<?php

/* 
Database connection
*/
function acmeConnect(){
$server = "localhost";
$database = "acme";
$user = "iClient";
$password = "rzusSSzc0M0q3n2t";
$dsn = 'mysql:host='.$server.';dbname='.$database;
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $acmeLink = new PDO($dsn, $user, $password, $options);
    return $acmeLink;
} catch (PDOException $exc) {
    header('location: /acme/acme/view/500.php');
    exit;
}
}
acmeConnect();

?>