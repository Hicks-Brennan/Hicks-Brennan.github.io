<?php

/*
** Products Controller
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
// Get the Products model 
require_once '../model/product-model.php';
// Get the Functions.php
require_once '../library/functions.php';
require_once '../model/uploads-model.php';
require_once '../model/review-model.php';

//Get array of categories
$categories = getCategories();
//var_dump($categories);
  //  exit;

    //  //Create a $catList variable for a drop down list
    //  $catList = '<select id="categoryId" name="categoryId">';
    //  foreach ($categories as $category) {
    //  $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>";
    //    }
    //  $catList .= '</select>';
 

//   // Build a navigation bar using the $categories array
//  $navList = '<ul>';
//  if (!$action) {
//  $navList .= "<li><a class='active' href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
//  }
//  else {
//   $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
//  }
//  foreach ($categories as $category) {
//    $activeTab='';
//    if($action == $category['categoryName']){
//      $active='active';
//   }
//   else {
//     $active='';
//   }
//   $navList .= "<li><a class='$active' href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
//  }
//  $navList .= '</ul>';

 //echo $navList;
   // exit;

   $navList = navigation($categories);

   if(($_SESSION)){
    $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
}

switch ($action) {
    case 'newCategory':
      //Filter and store Data
      $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

      //check for missing data
      if(empty($categoryName)){
        $message = '<p>Please provide new Category Name in box below.</p>';
        include '../view/addCategory.php';
        exit; 
        }
        
      //Send the data to the model
      $catOutcome = insCategory($categoryName);

      //Check and report the result
      if($catOutcome === 1) {
        $message = "<p>Congrats! New Category Added</p>";
        header('location:/acme/products');
        exit;
      } else {
        $message ="<p>Sorry $categoryName not added.";
        include '../view/addCategory.php';
        exit;
      }
    break;
    case 'newProduct':
            //Filter and store Data
      $invName = filter_input(INPUT_POST,'invName', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST,'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST,'invImage');
      $invThumbnail = filter_input(INPUT_POST,'invThumbnail');
      $invPrice = filter_input(INPUT_POST,'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = checkInt(filter_input(INPUT_POST,'invStock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invSize = checkInt(filter_input(INPUT_POST,'invSize', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invWeight = checkInt(filter_input(INPUT_POST,'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invLocation = filter_input(INPUT_POST,'invLocation', FILTER_SANITIZE_STRING);
      $categoryId = filter_input(INPUT_POST,'categoryId', FILTER_SANITIZE_NUMBER_INT);
      $invVendor = filter_input(INPUT_POST,'invVendor', FILTER_SANITIZE_STRING);
      $invStyle = filter_input(INPUT_POST,'invStyle', FILTER_SANITIZE_STRING);
      $invPrice = checkPrice($invPrice);



      //check for missing data
      if(empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/addProduct.php';
        exit; 
        }

      //Send the data to the model
      $prodOutcome = insProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

      //Check and report the result
      if($prodOutcome === 1) {
        $message = "<p>Congrats! New Product Added</p>";
        include '../view/productMtg.php';
        exit;
      } else {
        $message ="<p>Sorry $invName not added.";
        include '../view/addProduct.php';
        exit;
      }
    break;
    case 'addProduct':
      include '../view/addProduct.php';
      break;
    case 'addCategory':
      include '../view/addCategory.php';
      break;
    /* * ********************************** 
    * Get Inventory Items by categoryId 
    * Used for starting Update & delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
      // Get the categoryId 
      $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the products by categoryId from the DB 
      $productsArray = getProductsByCategory($categoryId); 
      // Convert the array to a JSON object and send it back 
      echo json_encode($productsArray); 
      break;

      case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if(count($prodInfo)<1){
         $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
       break;

       case 'updateProd':
        //Filter and store Data
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $categoryId = filter_input(INPUT_POST,'categoryId', FILTER_SANITIZE_NUMBER_INT);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
          



      //check for missing data
            if(empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)){
              $message = '<p>Please provide information for all empty form fields.</p>';
              include '../view/prod-update.php';
              exit; 
              }

      //Send the data to the model
             $updateResults = updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId);

      //Check and report the result
            if($updateResults === 1) {
              $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
              $_SESSION['message'] = $message;
                header('location: /acme/products/');
              exit;
            } else {
              $message ="<p>Sorry $invName not updated.";
              include '../view/prod-update.php';
              exit;
            }
       break;

       case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if(count($prodInfo)<1){
         $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
       break;

       case 'deleteProd':
        //Filter and store Data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        //Send the data to the model
        $deleteResults = deleteProduct($invId);

        //Check and report the result
        if($deleteResults === 1) {
          $message = "<p class='notify'>Congratulations, $invName was successfully deleted.</p>";
          $_SESSION['message'] = $message;
            header('location: /acme/products/');
          exit;
        } else {
          $message ="<p>Sorry $invName not deleted.";
          $_SESSION['message'] = $message;
          header('location: /acme/products/');
          exit;
        }
        break;

        case 'category':
          $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
          $products = getProductsByCategoryName($categoryName);
          if (!count($products)){
            $message = "<p class='notify'>Sorry, no $categoryName products could be found</p>";

          }else {
            $prodDisplay = buildProductsDisplay($products);
          }
          //echo $prodDisplay;
          //exit;
          include '../view/category.php'; 
        break;

        case 'prodDetail':
          $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
          $prodInfo = getProductInfo($invId);
          $thumbInfo = checkThumbnail($invId);
          $reviewInfo = getReviewsByInvId($invId);
          if (!count($prodInfo)){
            $message = "<p class='notify'>Sorry, that product could not be found</p>";
        } else {
          $productInfo = prodDetails($prodInfo);
        }
        
        $imgThumb = displayThumbs($thumbInfo);
        $reviewsCurr = buildProductReviews($reviewInfo);
        //echo $productInfo;
        //exit;
          include '../view/prod-detail.php';
        break;

    default:

    $categoryList = buildCategoryList($categories);
       include '../view/productMtg.php';
}

?>