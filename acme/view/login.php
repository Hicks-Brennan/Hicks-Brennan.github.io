<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
</head>
<body>
<div class="bg">
    <div class="content">
    <header id="page_header"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> </header>
        <main id="logForm">
            <h1>Acme Login</h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <form action="/acme/accounts/" method="post">
                <label for="clientEmail">E-Mail Address:</label>
                <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>required><br>
                <label for="clientPassword">Password:</label><br>
                <span>Passwords must be at least 8 characters and contains at least 1 number, 1 capital, and 1 special character</span>
                <input type="password" id="password" name="clientPassword" requiredpattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ><br>
                <input type="submit" value="Submit">
                <input type="hidden" name="action" value="Login">
                </form>
            <h3>Not a member?</h3>
            <a id="button" href="/acme/accounts/index.php?action=registration">Create New Account</a>

        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>