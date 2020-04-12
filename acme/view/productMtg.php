<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
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
        
        <main>
            <h1><u>Product Management Page</u></h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <p>Following the Links below you are able to add Categories or Products to our line up of items.</p>

            <a href="/acme/products/index.php?action=addCategory">Add Categories Here</a><br>
            <a href="/acme/products/index.php?action=addProduct">Add Product Here</a>

                <?php
                    if (isset($message)) { 
                    echo $message; 
                    } 
                    if (isset($categoryList)) { 
                    echo '<h2>Products By Category</h2>'; 
                    echo '<p>Choose a category to see those products</p>'; 
                    echo $categoryList; 
                    }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>

                <table id="productsDisplay"></table>

        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
<script src="../js/products.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>