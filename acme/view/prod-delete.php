<?php
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
    <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title>
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
        <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <form id="productForms" action="/acme/products/index.php" method="post">

                <label for="invName">Product Name:</label>
                <input type="text" id="invName" name="invName" 
                <?php if(isset($prodInfo['invName'])) {
                    echo "value='$prodInfo[invName]'";}?> ><br>

                <label for="invDescription">Product Description:</label>
                <input type="text" id="invDescription" name="invDescription" 
                <?php if(isset($prodInfo['invDescription'])) {
                    echo "value='$prodInfo[invDescription]'";}?> ><br>

                <input type="submit" name="submit" value="Delete Product"> 
                <input type="hidden" name="action" value="deleteProd">
                <input type="hidden" name="invId" 
                    value="<?php if(isset($invId)){ echo $invId; } ?>">


            </form>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>