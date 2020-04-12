<?php

/*
** Accounts Controller
*/

//Create or access a Session
session_start();
   $action = filter_input(INPUT_POST, 'action');
   if ($action == NULL) {
       $action = filter_input(INPUT_GET, 'action');
   }

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the account model for use as needed
require_once '../model/accounts-model.php';
// Get the functions.php
require_once '../library/functions.php';
require_once '../model/review-model.php';

//Get array of categories
$categories = getCategories();
//var_dump($categories);
  //  exit;

  // Build a navigation bar using the $categories array
 $navList = navigation($categories);

 //echo $navList;
   // exit;

   // Check if the firstname cookie exists, get its value
if (isset($_SESSION['loggedin'])) {
    $clientData = getClient($_SESSION['clientData']['clientEmail']);
    


    // Remove the password from the array
    // the array_pop function removes the last element from an array
    array_pop($clientData);
}

if(($_SESSION)){
    $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
}

switch ($action) {
    case 'login';
   

        include '../view/login.php';
    break;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        //checking for existing email
        $existingEmail = checkExistingEmail($clientEmail);

        if ($existingEmail) {
            $message = '<p> That email already has an account linked to it, please login instead.</p>';
            include '../view/login.php';
            exit;
        }


        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
    break;

    case 'registration':

        include '../view/registration.php';
    break;

    case 'Login';

        //filter and store the data
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($clientPassword);
        

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        
        //delete Cookie
        if(isset($_COOKIE['firstname'])){
        setcookie('firstname', '', time()-3600, '/');
        }
        //create the cookie 
        setcookie('firstname', $_SESSION['clientData']['clientFirstname'], strtotime('+1 year'), '/');
        setcookie('firstname', '', time()-3600, '/');

        $cookieFirstname = ($_SESSION['clientData']['clientFirstname']);
        
        $reviews = getReviewsByClientId($clientData['clientId']);
        $reviewsClient = buildClientReviews($reviews);
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;
    case 'logout';
        session_unset();
        session_destroy();
        setcookie('firstname', '', strtotime('-1 year'), '/');
        include '../index.php';
    break;

    case 'update':
        
        include '../view/client-update.php';
    break;

    case 'updateAcct':
        //filter inputs
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientEmail = checkEmail($clientEmail);

        //check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
            }

        //send data to the model
        $updateAcctresults = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if($updateAcctresults === 1) {
            $message = "<p class='notify'>Congratulations, $clientFirstname was successfully updated.</p>";
            $_SESSION['message'] = $message;
              header('location: /acme/accounts/');
            exit;
          } else {
            $message ="<p>Sorry $clientFirstname not updated.";
            include '../view/client-update.php';
            exit;
          }
    break;

    case 'updatePassword':
        //filter inputs
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        //check if empty
        if(empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        //send to model
        $updatePWresults = updatePassword($hashedPassword, $clientId);

        if($updatePWresults === 1) {
            $message = "<p class='notify'>Congratulations, $clientFirstname password was successfully updated.</p>";
            $_SESSION['message'] = $message;
              header('location: /acme/accounts/index.php');
            exit;
          } else {
            $message ="<p>Sorry $clientFirstname password not updated.";
            include '../view/client-update.php';
            exit;
          }

    break;
    

    default:
    setcookie('firstname', $_SESSION['clientData']['clientFirstname'], strtotime('+1 year'), '/');
    $reviews = getReviewsByClientId($clientData['clientId']);
    $reviewsClient = buildClientReviews($reviews);
        include '../view/admin.php';
    break;
}

?>