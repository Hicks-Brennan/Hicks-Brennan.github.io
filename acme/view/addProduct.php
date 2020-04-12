<?php
     //Create a $catList variable for a drop down list
     $catList = '<select id="categoryId" name="categoryId">';
     foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        if(isset($categoryId)){
            if($category['categoryId'] === $categoryId) {
                $catList .= ' selected ';
            }
        }
        $catList .= ">$category[categoryName]</option>";
       }
     $catList .= '</select>';
    if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
</head>
<body>
<div class="bg">
    <div class="content">
    <header id="page_header"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> </header>
        
        <main>
            <h1><u>Add Products</u></h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <form id="productForms" action="/acme/products/index.php" method="post">
                <label for="categoryId">Category Id</label>
                <?php echo $catList; ?><br>
                <label for="invName">Product Name:</label>
                <input type="text" id="invName" name="invName" <?php if(isset($invName)){echo "value='$invName'";} ?> required><br>
                <label for="invDescription">Product Description:</label>
                <input type="text" id="invDescription" name="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required><br>
                <label for="invImage">Product Image:</label>
                <input type="text" id="invImage" name="invImage" value="/acme/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required><br>
                <label for="invThumbnail">Product Thumbnail:</label>
                <input type="text" id="invThumbnail" name="invThumbnail" value="/acme/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required><br>
                <label for="invPrice">Product Price:</label>
                <input type="number" id="invPrice" step=".01" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required><br>
                <label for="invStock">Product Stock:</label>
                <input type="number" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required><br>
                <label for="invSize">Product Size:</label>
                <input type="number" id="invSize" name="invSize" <?php if(isset($invSize)){echo "value='$invSize'";} ?> required><br>
                <label for="invWeight">Product Weight:</label>
                <input type="number" id="invWeight" name="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";} ?> required><br>
                <label for="invLocation">Product Location:</label>
                <input type="text" id="invLocation" name="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";} ?> required><br>
                <label for="invVendor">Product Vendor</label>
                <input type="text" id="invVendor" name="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";} ?> required><br>
                <label for="invStyle">Product Style</label>
                <input type="text" id="invStyle" name="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";} ?> required><br>
                <input type="submit" name="Submit">
                <input type="hidden" name="action" value="newProduct">


            </form>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>