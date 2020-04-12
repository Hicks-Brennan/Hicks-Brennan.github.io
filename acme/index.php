<?php

/*
** Acme Controller
*/

//Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
//get functions.php
require_once 'library/functions.php';

  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL) {
      $action = filter_input(INPUT_GET, 'action');
  }

  // Build a navigation bar using the $categories array
  $categories = getCategories();
 $navList = navigation($categories);

 //echo $navList;
   // exit;

// Check if the firstname cookie exists, get its value
if(($_SESSION)){
  $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
}

switch ($action) {
    case 'something':
    break;

    default:
        include 'view/home.php';
}

?>