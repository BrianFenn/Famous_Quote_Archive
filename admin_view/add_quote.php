<?php include '../view/header.php';
require_once('../util/valid_admin.php');
 ?>
<main>
    <h1>Add Quote</h1>
    <form action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_quote">

        
        <label>Quote:</label>
        <input type="text" name="quote_Text" required="" />
        <br>
   
        

        <label>Author Name:</label>
        <select id="mobile_add_vehicle" name="authorID">
        <?php foreach ( $authors as $author ) : ?>
            <option value="<?php echo $author['authorID']; ?>" required="">
                <?php echo $author['author_Name']; ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br>
       

        <label>Categories:</label>
        <select id="mobile_add_vehicle" name="categoryID">
        <?php foreach ( $categories as $category ) : ?>
            <option value="<?php echo $category['categoryID']; ?>" required="">
                <?php echo $category['category_Name']; ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br>

        
        <label>&nbsp;</label>
        
        <input  id="button" type="submit" value="Add Quote" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_quotes">View Famous Quote Archive</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>