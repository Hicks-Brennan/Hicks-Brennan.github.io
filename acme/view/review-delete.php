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

            <h2 class='warning'>After review has been deleted it cannot be recovered</h2>

            <form id="reviewUpdate" action="/acme/reviews/index.php" method="post">
            
                <label for="reviewText">Review Text:</label>
                <input type="text" name="reviewText" id="reviewText" value="<?php 
                    if(isset($reviewText)){
                        echo $reviewText;
                    }
                    elseif(isset($review['reviewText'])){
                        echo $review['reviewText'];                
                    }
                ?>" readonly>
                <input type="submit" name="submit" value="Delete Review"> 
                <input type="hidden" name="action" value="delete">
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