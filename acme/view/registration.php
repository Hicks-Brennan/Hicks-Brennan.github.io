<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
</head>
<body>
<div class="bg">
    <div class="content">
    <header id="page_header"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> </header>
        <main id="regForm">
            <h1>Acme Registration</h1>
        <?php
            if (isset($message)){
                echo $message;
            }
        ?> 
            <form action="/acme/accounts/index.php" method="post">
                <label for="clientFirstname">First Name:</label>
                <input type='text' name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required><br>
                <label for="clientLastname">Last Name:</label>
                <input type="text" id="lastName" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>required><br>
                <label for="clientEmail">E-Mail Address:</label>
                <input type="email" id="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required placeholder="Enter a valid Email Address"><br>
                <label for="clientPassword">Password:</label><br>
                <span>Passwords must be at least 8 characters and contains at least 1 number, 1 capital, and 1 special character</span>
                <input type="password" id="password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ><br>
                <input type="submit" name="submit" value="Register">
                <input type="hidden" name="action" value="register">
            </form>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>