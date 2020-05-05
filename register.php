<?php include 'view/header.php'; ?>

<link rel="stylesheet" type="text/css"
          href="view/main.css">
<main>
    <h1>Register</h1>
    <form action="index.php" method="get" id="add_product_form">
        <input type="hidden" name="action" value="register_customer">

        
        

        <label>Please enter your first name:</label>
        <input type="text" name="firstname" required="">
        <br>
        
        <input  id="button" type="submit" value="Register" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_quotes">View Quotes List</a>
    </p>

</main>
<?php include 'view/footer.php'; ?>