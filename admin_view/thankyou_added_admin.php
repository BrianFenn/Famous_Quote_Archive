<?php include '../view/header.php';
// include_once 'index.php';

?>
<link rel="stylesheet" type="text/css"
          href="view/main.css">
<main>
    
    
    
    <br>
    <?php 

    echo "Your New Login Credentials have been created.  Please keep record of the username and password." . "<br><br>" . 
     "If you lose your login information, you'll have to ask the database adminstrator to remove the user, and create a new username & password.";
    ?>
    
    <br>
    <br>
        <a href="index.php?action=list_quotes">Return to Famous Quotes Archive</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>