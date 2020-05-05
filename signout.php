 <?php 
 include_once('index.php');
 include_once('view/header.php');
?>
<link rel="stylesheet" type="text/css"
          href="view/main.css">

  <?php      
    //$firstname = filter_input(INPUT_GET, 'firstname');

    //$_SESSION['firstname'] = $firstname;
    $sessionfirstname = $_SESSION['firstname'];
    echo "<h1>Thank you for signing out, ". $_SESSION['firstname'] . "!</h1>";
    //echo $firstname;
    //session_start();
     //echo $sessionfirstname;
    $_SESSION = array();
    session_destroy();
    //session_start();
    //$name = session_name();
    //$params = session_get_cookie_params();
    //$path = $params['/'];
    //setcookie($name, '', time() -3600, $path);  
    //session_start();
    

 ?>
 
 
<main>
    
    
    <h2>
    <?php 

//if ($firstname == NULL || $firstname == FALSE) {
  //  echo "Please go back and register your name";
// }
// else {

    
    //echo "Thank you for signing out, ". $_SESSION['firstname'] . "!";
    //echo "<br><br>";
    //print_r($_COOKIE);
    //echo "<br><br>";
    //echo session_name();
   //echo session_get_cookie_params();
    //echo session_get_cookie_params()['domain'];
    //session_destroy();
    //$removecookie;
   // }     
    ?>

    </h2>


    <p class="last_paragraph">
        <a href="index.php?">View Quotes List</a>
    </p>

</main>
<?php include 'view/footer.php'; ?>