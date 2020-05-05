<?php
    //require_once('util/secure_conn.php');  // require a secure connection
    include('view/header.php');
    include_once("model/admin_db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Famous Quotes Archive</title>
        <link rel="stylesheet" type="text/css" href="view/main.css"/>
    </head>
    <body>
        <header>
            
        </header>
        <main>
            <h1>Login</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="aligned" method="post">
                <input type="hidden" name="action" value="login">

                <label>Username:*</label>
                <input type="text" class="text" name="username">
                <?php
                if (empty($username)) {
                $error_username_invalid = "Please enter your username.";
                echo $error_username_invalid;
                }
                ?>

                <br>

                <label>Password:*</label>
                <input type="password" class="text" name="password">
                <?php
                if (empty($password)) {
                $error_password_invalid = "Please enter a password.";
                echo $error_password_invalid;
                empty($password);
                empty($valid_login);
                } if (!empty($_SESSION['valid_login']) && !empty($password)) {echo "Invalid Username and/or Password.";
                empty($_SESSION['valid_login']);
                empty($password);};
                
                ?>
                <br>

                <label>&nbsp;</label>
                <input type="submit" value="Login">
                <p>* Indicates a required field</p>
            </form>

            
        </main>
    </body>
</html>