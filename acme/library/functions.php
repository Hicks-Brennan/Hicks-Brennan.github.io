<?php
function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
   }

   function checkInt($number){
    return filter_var($number, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0)));
}

function checkPrice($invPrice){
    //$pattern = '[0-9]+\.[0-9][0-9]';
    //HTML -> pattern="\d+(\.\d{2})?"
    if (strlen(substr(strrchr($invPrice, "."), 1)) < 3 && $invPrice >= 0){
            return filter_var($invPrice, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    } else{
            return NULL;
    }
}

// Build a navigation bar using the $categories array
function navigation($categories) {
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    }
    $navList = '<ul>';
    if (!$action) {
    $navList .= "<li><a class='active' href='/acme/' title='View the Acme home page'>Home</a></li>";
    }
    else {
    $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
    }
    foreach ($categories as $category) {
    $activeTab='';
    if($action == $category['categoryName']){
        $active='active';
    }
    else {
        $active='';
    }
    $navList .= "<li><a  href='/acme/products/?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the categories select list 
function buildCategoryList($categories){ 
    $catList = '<select name="categoryId" id="categoryList">'; 
    $catList .= "<option>Choose a Category</option>"; 
    foreach ($categories as $category) { 
    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $catList .= '</select>'; 
    return $catList; 
}

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
     $pd .= '<li>';
     $pd .= "<a href=/acme/products/?action=prodDetail&id=$product[invId]><img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
     $pd .= '<hr>';
     $pd .= "<h2>$product[invName]</h2></a>";
     $pd .= "<span>$product[invPrice]</span>";
     $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
   }

   function prodDetails($prodInfo){
       $prodDetails = '<div id="prod-details">';
       $prodDetails .= "<h1>$prodInfo[invName]</h1><br>";
       $prodDetails .= '<div id="detailGrid">';
       $prodDetails .= "<img src='$prodInfo[invImage]' alt='Image of $prodInfo[invName]'>";
       $prodDetails .= '<div id="leftSide">';
       $prodDetails .= "<h3 class='vendor'>By $prodInfo[invVendor]</h3>";
       $prodDetails .= "<h2 class='highlight'>$prodInfo[invStock] left in stock</h2>";
       $prodDetails .= "<p>$prodInfo[invDescription]</p>";
       $prodDetails .= "<ul><li>Size: $prodInfo[invSize] in&sup3;</li>";
       $prodDetails .= "<li>Weight: $prodInfo[invWeight] lbs</li>";
       $prodDetails .= "<li>Material: $prodInfo[invStyle]</li></ul>";
       $prodDetails .= "<h2 class='highlight'>$$prodInfo[invPrice]</h2>";
       $prodDetails .= "<h3>Ships from $prodInfo[invLocation]</h3>";
       $prodDetails .= "</div>";
       $prodDetails .= "</div>";
       $prodDetails .= "</div>";
       return $prodDetails;
        
   }

   function displayThumbs($thumbs) {
    $thumbnails = "<h2>Thumbnails for Product</h2>";
    $thumbnails .= "<ul id='thumb-display'>";
    foreach($thumbs as $thumb) {
        $thumbnails .= "<li><img src='$thumb[imgPath]' alt='Backup Images for Product'></li>";
    }
    $thumbnails .= "</ul>";
    return $thumbnails;
}

   /* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }

   // Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
     $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
   }

   // Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
     $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }

   // Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

   // Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

   // Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the resizeImage function
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends the if - else began on line 36

   // Build the list of products reviews to display.
function buildProductReviews($reviews) {
    if(count($reviews) >0) {
        $reviewList = "<div class='review-items'>";
        foreach ($reviews as $review) {
          
            $reviewList .= "<div class='reviews'>";
            $reviewList .= "<div class='col1'>" . $review['reviewText'] . "</div>";
            $reviewList .= "<div class='col2'>Reviewed by: " . substr($review['clientFirstname'],0, 1) . $review['clientLastname'] . "</div>";
            $reviewList .= "<div class='col3'>Reviewed on: " .$review['reviewDate'] ."</div>";
            $reviewList .= "</div>";
        }
            $reviewList .= '</div>';
        } else {
            $reviewList = '<p class="notify">Sorry, no reviews were found.</p>';
        }
    return $reviewList;
}


// Build the list of reviews for a user to manage.
function buildClientReviews($reviews) {
    if(count($reviews) > 0) {
        $reviewList = "<div class='reviewClient'>";
        foreach ($reviews as $review) {
            $reviewList .= "<div class='reviewsIndividual'>";
            $reviewList .= "<h3 class='invName'>" . $review['invName'] . "</h3>";
            $reviewList .= "<p class='reviewText'>{" . $review['reviewText'] . "}</p>";
            $reviewList .= "<div class='edit'><a href='/acme/reviews/index.php?action=updateRev&id=" . $review['reviewId'] . "' title='Click to modify'>Edit</a>";
            $reviewList .= " <a href='/acme/reviews/index.php?action=deleteRev&id=" . $review['reviewId'] . "' title='Click to delete'>Delete</a></div>";
            $reviewList .= "</div>";
        }
            $reviewList .= '</div>';
        } else {
            $reviewList = '<p class="notify">Sorry, no reviews were found.</p>';
        }
    return $reviewList;
}

?>