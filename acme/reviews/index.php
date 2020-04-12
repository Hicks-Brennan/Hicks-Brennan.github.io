<?php

// Reviews Controller 
// yellow color yellow: #f7f193


//start session
session_start();

//get required
require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/acme-model.php';
require_once '../model/review-model.php';
require_once '../model/product-model.php';
require_once '../model/accounts-model.php';

//get action for switch statement
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

if (isset($_SESSION['loggedin'])) {
    $clientData = getClient($_SESSION['clientData']['clientEmail']);
    array_pop($clientData);
}

// Build a navigation bar using the $categories array
$categories = getCategories();
$navList = navigation($categories);
if(($_SESSION)){
    $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
}
//switch statement for handling 
switch($action) {
    case 'create':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = $_SESSION['clientData']['clientId'];
        $prodDetail = getProductInfo($invId);
        if (empty($prodDetail)) {
            $message = "<p>Sorry, no product was found.</p>";
            include ($_SERVER['DOCUMENT_ROOT'].'../view/home.php');
            exit;
        }
        if(empty($reviewText)){
                $_SESSION['message'] = '<p>The review cannot be empty.</p>';
                header("location: /acme/products?action=prodDetail&id=$invId");
                exit;
        }
        
        $addReviewResult = addReview($invId, $clientId, $reviewText);
                
        if ($addReviewResult < 1) {
                $_SESSION['message'] = "<p>Sorry, but your review wasn't added. Please try again.</p>";
                header("location: /acme/products?action=prodDetail&id=$invId");
                exit;
        } else{
                $_SESSION['message'] = "<p>your review was added successfully.</p>";
                header("location: /acme/products?action=prodDetail&id=$invId");
                exit;
        }

    break;

    case 'updateRev':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $review = getReviewById($reviewId);
        if(count($review)<1){
                $message = 'Sorry, no review information could be found.';
               }
               include '../view/review-update.php';
    break;

    case 'update':
        // Filter and store the data
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
            $review = getReviewById($reviewId);
            if (empty($review)) {
                    $_SESSION['message'] = "Sorry, review could not be found";
                    header('location: /acme/accounts');
                    exit;
            }
            // Check for missing data
            if(empty($reviewText)){
                    $message = '<p>The review cannot be empty.</p>';
                    include '../view/review-update.php';
                    exit;
            }
            
            $updateReviewResult = updateReview($reviewId, $reviewText);
                    
            if ($updateReviewResult < 1) {
                    $message = "<p>Sorry, but your review wasn't updated. Please try again.</p>";
                    include '../view/review-update.php';
                    exit;
            } else{
                    $_SESSION['message'] = "<p>your review was updated successfully.</p>";
                    header('location: /acme/accounts');
                    exit;
            }
    break;

    case 'deleteRev':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $review = getReviewById($reviewId);
        if(count($review)<1){
         $message = 'Sorry, no review information could be found.';
        }
        include '../view/review-delete.php';
        exit;
    break;

    case 'delete':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $review = getReviewById($reviewId);
            if (empty($review)) {
                    $_SESSION['message'] = "Sorry, review could not be found";
                    header('location: /acme/accounts');
                    exit;
            }
            
            $deleteReviewResult = deleteReview($reviewId);
                    
            if ($deleteReviewResult < 1) {
                    $message = "<p>Sorry, but your review wasn't deleted. Please try again.</p>";
                    include ($_SERVER['DOCUMENT_ROOT'].'/view/review-delete.php');
                    exit;
            } else{
                    $_SESSION['message'] = "<p>your review was deleted successfully.</p>";
                    header('location: /acme/accounts');
                    exit;
            }
    break;

    default:
      if($_SESSION){  
            include '../view/admin.php';
      } else {
            include '../acme/';
      }
}

?>