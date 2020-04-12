<?php
  // Build the categories option list
 $catList = '<select name="categoryId" id="categoryId">';
 $catList .= "<option>Choose a Category</option>";
 foreach ($categories as $category) {
  $catList .= "<option value='$category[categoryId]'";
  if(isset($categoryId)){
   if($category['categoryId'] === $categoryId){
    $catList .= ' selected ';
   }
  } elseif(isset($prodInfo['categoryId'])){
   if($category['categoryId'] === $prodInfo['categoryId']){
    $catList .= ' selected ';
   }
  }
 $catList .= ">$category[categoryName]</option>";
 }
 $catList .= '</select>';
     $catList .= '</select>';
    if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <title>
        <?php if(isset($prodInfo['invName'])){ 
            echo "Modify $prodInfo[invName] ";} 
            elseif(isset($invName)) { echo $invName; } ?> | Acme Inc
        </title>
    <link rel="stylesheet" media="screen" href="/acme/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
 
    <!-- Javascript -->
    <script src="js/scripts.js"></script>
</head>
<body>
<div class="bg">
    <div class="content">
    <header id="page_header"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> </header>
        
        <main>
        <h1><?php if(isset($prodInfo['invName'])){ 
       echo "Modify $prodInfo[invName] ";} 
       elseif(isset($invName)) { echo $invName; }?></h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <form id="productForms" action="/acme/products/index.php" method="post">
                <label for="categoryId">Category Id</label>
                <?php echo $catList; ?><br>

                <label for="invName">Product Name:</label>
                <input type="text" id="invName" name="invName" 
                <?php if(isset($invName)){echo "value='$invName'";} 
                elseif(isset($prodInfo['invName'])) {
                    echo "value='$prodInfo[invName]'";}?> required><br>

                <label for="invDescription">Product Description:</label>
                <input type="text" id="invDescription" name="invDescription" 
                <?php if(isset($invDescription)){echo "value='$invDescription'";} 
                elseif(isset($prodInfo['invDescription'])) {
                    echo "value='$prodInfo[invDescription]'";}?> required><br>

                <label for="invImage">Product Image:</label>
                <input type="text" id="invImage" name="invImage" value="/acme/images/no-image.png" 
                <?php if(isset($invImage)){echo "value='$invImage'";} 
                elseif(isset($prodInfo['invImage'])) {
                    echo "value='$prodInfo[invImage]'";}?> required><br>

                <label for="invThumbnail">Product Thumbnail:</label>
                <input type="text" id="invThumbnail" name="invThumbnail" value="/acme/images/no-image.png" 
                <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} 
                elseif(isset($prodInfo['invThumbnail'])) {
                    echo "value='$prodInfo[invThumbnail]'";}?> required><br>
                
                <label for="invPrice">Product Price:</label>
                <input type="number" id="invPrice" step=".01" name="invPrice"  
                <?php if(isset($invPrice)){echo "value='$invPrice'";} 
                elseif(isset($prodInfo['invPrice'])) {
                    echo "value='$prodInfo[invPrice]'";}?> required><br>

                <label for="invStock">Product Stock:</label>
                <input type="number" id="invStock" name="invStock"
                <?php if(isset($invStock)){echo "value='$invStock'";} 
                elseif(isset($prodInfo['invStock'])) {
                    echo "value='$prodInfo[invStock]'";}?> required><br>

                <label for="invSize">Product Size:</label>
                <input type="number" id="invSize" name="invSize" 
                <?php if(isset($invSize)){echo "value='$invSize'";} 
                elseif(isset($prodInfo['invSize'])) {
                    echo "value='$prodInfo[invSize]'";}?> required><br>

                <label for="invWeight">Product Weight:</label>
                <input type="number" id="invWeight" name="invWeight" 
                <?php if(isset($invWeight)){echo "value='$invWeight'";} 
                elseif(isset($prodInfo['invWeight'])) {
                    echo "value='$prodInfo[invWeight]'";}?> required><br>

                <label for="invLocation">Product Location:</label>
                <input type="text" id="invLocation" name="invLocation"
                <?php if(isset($invLocation)){echo "value='$invLocation'";} 
                elseif(isset($prodInfo['invLocation'])) {
                    echo "value='$prodInfo[invLocation]'";}?> required><br>

                <label for="invVendor">Product Vendor</label>
                <input type="text" id="invVendor" name="invVendor" 
                <?php if(isset($invVendor)){echo "value='$invVendor'";} 
                elseif(isset($prodInfo['invVendor'])) {
                    echo "value='$prodInfo[invVendor]'";}?> required><br>

                <label for="invStyle">Product Style</label>
                <input type="text" id="invStyle" name="invStyle" 
                <?php if(isset($invStyle)){echo "value='$invStyle'";} 
                elseif(isset($prodInfo['invStyle'])) {
                    echo "value='$prodInfo[invStyle]'";}?> required><br>

                <input type="submit" name="submit" value="Update Product"> 
                <input type="hidden" name="action" value="updateProd">
                <input type="hidden" name="invId" 
                    value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>">


            </form>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>