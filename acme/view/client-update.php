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
        
        <main>
            <h1><u>Update Account Information</u></h1>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?> 
            <form id="accountInfo" action="/acme/accounts/" method='post'>
                <label for="clientFirstname">First Name:</label>
                <input type="text" id="clientFirstname" name="clientFirstname" <?php if(isset($clientData['clientFirstname'])) {echo "value='$clientData[clientFirstname]'"; } ?> required><br>

                <label for="clientLastname">Last Name:</label>
                <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientData['clientLastname'])) {echo "value='$clientData[clientLastname]'"; } ?>  required><br>

                <label for="clientEmail">Email:</label>
                <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientData['clientEmail'])) {echo "value='$clientData[clientEmail]'"; } ?>  required><br>
                <input type="submit" name="submit" value="Update Account Information">
                <input type="hidden" name="action" value="updateAcct">
                <input type="hidden" name="clientId" 
                    value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} ?>">
            </form>

            
            <form id="passwordInfo" action='/acme/accounts/' method='post'>
                <label for="clientPassword">Password:</label>
                <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ><br>
                <input type="submit" name="submit" value="Update Password">
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} ?>">

            </form>
        </main>

        <footer id="page_footer"> <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> </footer>
    </div>
</div>
</body>
</html>