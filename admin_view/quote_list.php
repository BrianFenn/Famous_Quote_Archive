<?php include('../view/header.php');
require_once('../util/valid_admin.php');

?>




<main>
    <h1>Famous Quote Archive</h1>
    <?php if ( sizeof($categories) != 0) { ?>
                <form action="." method="get" id="category_selection">
                <label>Class:</label>
                <select name="categoryID">
                    <option value="0">View All Categories</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['categoryID']; ?>">
                            <?php echo $category['category_Name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
                <?php } ?>
            

            <?php if ( sizeof($authors) != 0) { ?>
                <form action="." method="get" id="category_selection">
                <label>Author:</label>
                <select name="authorID">
                    <option value="0">View All Authors</option>
                    <?php foreach ($authors as $author) : ?>
                        <option value="<?php echo $author['authorID']; ?>">
                            <?php echo $author['author_Name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
                <?php } ?>

           
               
               
                
                <input type="submit" value="Submit" id="button" class="button blue">
                </form>
            

        <!-- display a table of vehicles -->
       
<?php if ( sizeof($quotes) == 0) { 
    
    echo "There are currently no quotes under your specified conditions, please make a valid selection.";
} else { ?>
                
                <div id="table-scroll">          
    <section>    
        
        
        <table>
            <tr>
                
               
                <th>Author</th>
                <th>Quote</th>
                <th class="right">Category</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($quotes as $quote) : ?>
            <tr>
                
                
                <td><?php echo $quote['author_Name']; ?></td>
                <td><?php echo $quote['quote_Text']; ?></td>
                <td class="right"><?php echo $quote['category_Name']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_quote">
                    <input type="hidden" name="quoteID"
                           value="<?php echo $quote['quoteID']; ?>">
                    <input type="hidden" name="categoryID"
                           value="<?php echo $quote['categoryID']; ?>">
                    <input type="submit" value="Delete" id="button">
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
            <a href="?action=manage_users">Manage Users</a>
            <br>
            <br>
            <a href="?action=view_submissions">View Submissions</a>
            <br>
            <br>
            <a href="..?">View Consumer Site</a>
            <br>
            <br>
            <a href="?action=admin_logout">Logout</a>

        </p>
    </section>
</main>
<?php include '../view/footer.php'; ?>