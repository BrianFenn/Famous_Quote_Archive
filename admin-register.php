<?php include('view/header.php'); 
        //include('model/admin_db.php'); 
        //include_once('model/database.php');
        //include('admin_view/index.php');'
        require_once('util/valid_admin.php');
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');

?>

<link rel="stylesheet" type="text/css"
          href="view/main.css">

    

<main>
    <h1>Register a new admin user</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="add_product_form">
        
        <input type="hidden" name="action" value="register_admin_user">


         
        <label>Username:*</label>
        <input type="text" name="username" />
        <?php
        if (isset($error_username)) {
            echo $error_username . " ";
            }
            if (isset($user_name_exists)) {
            echo $user_name_exists;
            }
        ?>
        <br>

        <label>Password:*</label>
        <input type="text" name="password" />
        <?php
        if (isset($error_password)) {
            echo $error_password;
        }
        ?>
        <br>

        <label>Confirm Password:*</label>
        <input type="text" name="confirm_password" />
        <?php
        if (isset($error_confirm_password)) {
           echo $error_confirm_password;
        }
        ?>
        <br>
        
       

        <input  id="button" type="submit" value="Register" />
        <br>

    <h3>* Indicates a required field.</h3>
    </form>
    
    <?php 
     /*  
    //is username empty
    if (empty($username)  || strlen($username) <= 5)   {
        $error_username = "Please enter a valid username with at least 6 characters.";
    } else {$error_username = ""; }

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    if (empty($password) || !$uppercase || !$lowercase || !$number || strlen($password) < 8 ) {
        $error_password = "Password must be at least: 1 uppercase and 1 lowercase letter, 1 number, and a minimum of 8 characters long.";
    }else {$error_password = ""; }

    if ($confirm_password != $password) {
        $error_confirm_password = "The passwords you entered do not match.";
    }else {$error_confirm_password = ""; }
*/
    
        //call add_admin function
        //add_admin($username,$password);
        //goto admin page
        //include('admin_view/index.php');
    
    
    

    //echo $username ."<br>" . $password;
    //echo "<br>" . $result;
    //echo $rowcount
    //echo $user_name_exists;
    ?>

    <a href ="index.php">Return to Main Menu</a>

</main>
<?php include 'view/footer.php'; ?>