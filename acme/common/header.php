<div class="logo">
    <img id="logo" src="/acme/images/site/logo.gif" alt="Acme Logo">
    <?php if (isset($_SESSION['loggedin'])) {
        echo "<div id='welcome'><a id='account' href='/acme/accounts/index.php'>Welcome $cookieFirstname</a>  |  <a title='account' id='logout' href='/acme/accounts/index.php?action=logout'>Logout</a></div>";
    } elseif(!($_SESSION)){
        if(isset($_COOKIE['firstname'])){
        echo "<div id='welcome'><p>Welcome $_COOKIE[firstname]</p></div>";
    }else {
        echo '';
    }
    echo '<a title="account" id="account" href="/acme/accounts/index.php?action=login"><img src="/acme/images/site/account.gif" alt="Account Button">My Account</a>';
}?>
    <nav><?php echo $navList; ?></nav>
</div>