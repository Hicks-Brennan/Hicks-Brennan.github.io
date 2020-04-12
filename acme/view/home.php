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
            <h1>Welcome to Acme!</h1>
        <div id="homeMain">
        <img src="/acme/images/site/rocketfeature.jpg" alt="background Rocket Feature">
        <ul>
            <li><h2>Acme Rocket</h2></li>
            <li>Quick lighting fuse</li>
            <li>NHTSA approved seat belts</li>
            <li>Mobile launch stand included</li>
            <li><a href="/acme/cart/"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
        </ul>
        </div>
        <div id="grid2"> 
        <div id="recReview">
            
                <h2>Acme Rocket Reviews</h2>
                <ul id="reviews">
                <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                <li>"That thing was fast!" (4/5)</li>
                <li>"Talk about fast delivery." (5/5)</li>
                <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
            </ul>
        </div>

        <div id="recipes">
            <h2>Featured Recipes</h2>
            <img class="bbq" src="/acme/images/recipes/bbqsand.jpg" alt="Pulled Roadrunner BBQ">
                <a class="bbq" title="bbq" href="?">Pulled Roadrunner BBQ</a>
            <img class="potpie" src="/acme/images/recipes/potpie.jpg" alt="Roadrunner PotPie">
                <a class="potpie" title="potpie" href="?">Roadrunner Pot Pie</a>
            <img class="soup" src="/acme/images/recipes/soup.jpg" alt="Roadrunner Soup">
                <a class="soup" title="soup" href="?">Roadrunner Soup</a>
            <img class="tacos" src="/acme/images/recipes/taco.jpg" alt="Roadrunner Tacos">
                <a class="tacos" title="tacos" href="?">Roadrunner Tacos</a>
  
        
        </div>
</div>
        


        </main>

        <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>