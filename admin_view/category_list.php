<?php include '../view/header.php'; 
require_once('../util/valid_admin.php');
?>

<main>
    <h1 style="color: blue">Famous Quote Category List</h1>
    <?php if ( sizeof($categories) == 0) { 
    
    echo "There are currently 0 Categories, feel free to begin adding some.";
} else { ?>
    
    <section>
        <table>
            <tr>
                <th colspan="2">Name</th>
            </tr>        
            <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?php echo $category['category_Name']; ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="categoryID"
                            value="<?php echo $category['categoryID']; ?>"/>
                        <input type="submit" value="Remove" id="button_delete" class="button red" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    </section>


    <section>
        <h2 style="">Add New Category</h2>
        <form action="." method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_category">

            <label>Name:</label>
            <input type="text" name="category_Name" max="30" required><br>

            <label>&nbsp;</label>
            <input type="submit" id="button" class="" value="Add Category"><br>
        </form>
    </section>

    <?php } ?>
    <section>
        <p><a href="index.php">View Famous Quote Archive</a></p>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Famous Quote Archive </p>
</footer>
</body>
</html>

