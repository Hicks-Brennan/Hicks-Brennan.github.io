<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <title><?php echo $categoryName; ?> | Acme, Inc.</title>
    <link rel="stylesheet" media="screen" href="/acme/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Bangers&displa  y=swap" rel="stylesheet">
 
    <!-- Javascript -->
    <script src="js/scripts.js"></script>
</head>
<body>
<div class="bg">
    <div class="content">
    <header id="page_header"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> </header>
        
        <main>
            <h1><?php echo $categoryName ?></h1>
            <?php if(isset($message)){
                echo $message; } 
            ?>
            <?php if(isset($prodDisplay)){ 
                echo $prodDisplay; 
            } ?>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>