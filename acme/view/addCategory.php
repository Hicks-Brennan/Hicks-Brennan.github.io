<?php
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
            <h1><u>Add a Category</u></h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <form id="productForms" action="/acme/products/index.php" method="post">
            <label for="categoryName">New Category Name:</label>
            <input type="text" id="categoryName" name="categoryName" required><br>
            <input type="submit" name="Submit">
            <input type="hidden" name="action" value="newCategory">
            </form>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>