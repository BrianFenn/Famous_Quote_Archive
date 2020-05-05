<?php include 'view/header_customer_view.php';

 ?>
<main>
    <h1>Submit Quote</h1>
    <form action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_submission">

        
        <label>Quote:</label>
        <input type="text" name="sub_Quote_Text" required="" />
        <br>
   
        

        <label>Author:</label>
        <input type="text" name="sub_Author_Name" required="" />
        <br>
        <br>
       

        <label>Category Name:</label>
        <input type="text" name="sub_Category_Name" required="" />
        <br>
        <br>
                
        <label>&nbsp;</label>
        
        <input  id="button" type="submit" value="Submit for Approval" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_quotes">View Famous Quote Archive</a>
    </p>

</main>
<?php include 'view/footer.php'; ?>