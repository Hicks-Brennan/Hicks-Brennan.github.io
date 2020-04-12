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
            <h1><u>Update Review</u></h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 

            <form id="reviewUpdate" action="/acme/reviews/index.php" method="post">
            
                <label for="reviewText">Review Text:</label>
                <input required type="text" id="reviewText" name="reviewText" value="<?php 
                    if(isset($reviewText)){
                        echo $reviewText;
                    }
                    elseif(isset($review['reviewText'])){
                        echo $review['reviewText'];                
                    }
                ?>">
                <input type="submit" name="submit" value="Update Review"> 
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="reviewId" 
                    value="<?php if(isset($review['reviewId'])){ echo $review['reviewId'];} 
                    elseif(isset($$reviewId)){ echo $reviewId; } ?>">
            </form>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>