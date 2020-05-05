<?php //include_once('../customer_view/index.php') ?>

<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Famous Quotes Archive</title>
    <link rel="stylesheet" type="text/css"
          href="view/main.css">
          <meta name="viewport" content="width=device-width, initial-scale=1">          
</head>

<!-- the body section -->
<body>
<?php 
//$firstname = filter_input(INPUT_GET, 'firstname');
 if (isset($_SESSION['firstname'] )) {
    $sessionfirstname = $_SESSION['firstname'];
 
    echo "<div id='login_status' >Welcome " . $_SESSION['firstname'] . "! ";
 ?>
 <a style="" href=signout.php?action=signout>Logout</a></div>
<?php } 

else { ?>
    <div id="login_status">
    <a href=register.php?action=signup>Register</a></div>
    
     <?php }   
    
    ?>

<header><h1>Famous Quotes Archive</h1></header>

