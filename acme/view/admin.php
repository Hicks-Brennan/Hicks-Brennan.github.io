<?php
if (!($_SESSION)){
    header("Location: /acme/index.php");
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
        
        <main class="adminPage">
            <h1><u>Admin Page</u></h1>
             
            <h3>You are Logged in!</h3>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <h1><?php echo $clientData['clientFirstname'] .' '. $clientData['clientLastname']; ?></h1>
            <ul class="userInfo">
                <li>First Name: <?php echo $clientData['clientFirstname'];?></li>
                <li>Last Name: <?php echo $clientData['clientLastname']; ?></li>
                <li>Email: <?php echo $clientData['clientEmail']; ?></li>
            </ul>
            <a href="/acme/accounts/index.php?action=update">Update Account Information</a>
            <?php 
            if(isset($reviewsClient)){
                echo $reviewsClient;
            }
            ?>

            <?php
                if($clientData['clientLevel'] > 1) { ?>
                <h1> Administrative Functions</h1>
                <p>Use the link below to manage products</p>
                <a href="/acme/products">Products</a><br>
                <a href="/acme/uploads">Upload Images</a>
                    
                <?php } ?>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>