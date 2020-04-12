<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <title><?php echo $invId; ?> | Acme, Inc.</title>
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
            <?php if(isset($message)){
                echo $message; } 
            ?>

             <?php if(isset($_SESSION['message'])){
                echo $_SESSION['message']; } 
            ?>
            <h3>Reviews can be viewed at the bottom of the page</h3>
            <?php if(isset($productInfo)){ 
                echo $productInfo;
            } ?> 
            <?php if(isset($imgThumb)){ 
                echo $imgThumb;
            } ?>
            <div class="reviewSection">
           <?php if (!isset($_SESSION['clientData'])){
										echo "<p>To add you own review please <a href='/acme/accounts?action=login'>Login</a></p>";
								} else {
										echo "<div id ='login'>";
										echo "<form method='post' action='/acme/reviews/'>";
										echo "<h2>Add a Review</h2>";
                                        echo "<label for='reviewText'>Screen Name: ";
                                        echo "<input type=text id=screenName value = '";
										echo substr($_SESSION['clientData']['clientFirstname'],0,1). $_SESSION['clientData']['clientLastname']."' readonly ></label>";
										echo "<textarea name='reviewText' id='reviewText' placeholder='Provide Your Review Here' required></textarea>";
										echo "<input type='hidden' name='invId' value='$invId'>";
										echo "<input type='hidden' name='action' value='create'>";
										echo "<input type='submit' value='Submit Review'>";
										echo "</form>";
										echo "</div>";
								}
								if (isset($reviewsCurr)) { echo "<h1>Customer Reviews</h1>".$reviewsCurr; }
                                else { echo "<h1>There are no Reviews for this product</h1>"; } ?>
            </div>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>