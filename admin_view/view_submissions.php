<?php include('../view/header.php');
require_once('../util/valid_admin.php');

?>




<main>
    <h1>Famous Quote Archive</h1>
   

           
               
               
              

        <!-- display a table of vehicles -->
       
<?php if ( sizeof($submissions) == 0) { 
    
    echo "You have no new submissions, please make a new selection.";
} else { ?>
                
                <div id="table-scroll">          
    <section>    
        
        
        <table>
            <tr>
                
               
                <th>Quote</th>
                <th>Author</th>
                <th class="right">Category</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($submissions as $submission) : ?>
            <tr>
                
            <td><?php echo $submission['sub_Quote_Text']; ?></td>
                <td><?php echo $submission['sub_Author_Name']; ?></td>
                
                <td class="right"><?php echo $submission['sub_Category_Name']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_submission">
                    <input type="hidden" name="sub_Quote_ID"
                           value="<?php echo $submission['sub_Quote_ID']; ?>">
                    <input type="hidden" name="sub_Category_Name"
                           value="<?php echo $submission['sub_Category_Name']; ?>">
                    <input type="submit" value="Delete" id="button">
                    </form></td>

                    
                    <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="approve_quote">
                        
                            <input type="hidden" name="sub_Quote_ID"
                            value="<?php echo $submission['sub_Quote_ID']; ?>">

                           <input type="hidden" name="sub_Quote_Text"
                            value="<?php echo $submission['sub_Quote_Text']; ?>"> 
                           
                    <input type="hidden" name="sub_Author_Name"
                            value="<?php echo $submission['sub_Author_Name']; ?>">  

                    <input type="hidden" name="sub_Category_Name"
                           value="<?php echo $submission['sub_Category_Name']; ?>">

                    <input type="submit" value="approve" id="button">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
            </div>

            <?php }
            //$quote_Text = filter_input(INPUT_POST, 'quote_Text');
            //echo "<br><br>" . $quote_Text . $authorID . $categoryID;
            //echo "<br><br>" . $_SESSION['quote_text'];
            ?>

        <p class="last_paragraph">
        
            <br>
            <a href="?action=list_quotes">View Famous Quotes</a>
            <br>
            <br>
            <a href="?action=show_add_form">Add Quote</a>
            <br>
            <br>
            <a href="?action=show_view_edit_categories_form">View/Edit Categories</a>
            <br>
            <br>
            <a href="?action=show_view_edit_authors_form">View/Edit Authors</a>
            <br>
            <br>
            <a href="?action=register_user">Add a new user</a>
            <br>
            <br>
            <a href="?action=admin_logout">Logout</a>

        </p>
    </section>
</main>
<?php include '../view/footer.php'; ?>