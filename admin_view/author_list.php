<?php include '../view/header.php'; 
require_once('../util/valid_admin.php');
?>

<main>
    <h1>Author List</h1>
    
    <?php if ( sizeof($authors) == 0) { 
    
    echo "There are currently 0 Authors, feel free to begin adding some.";
} else { ?>
    <section>
        <table>
            <tr>
                <th colspan="2">Name</th>
            </tr>        
            <?php foreach ($authors as $author) : ?>
            <tr>
                <td><?php echo $author['author_Name']; ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_author">
                        <input type="hidden" name="authorID"
                            value="<?php echo $author['authorID']; ?>"/>
                        <input type="submit" value="Remove" id="button_delete" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    </section>


    <section>
        <h2 >Add Author</h2>
        <form action="." method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_author">

            <label>Name:</label>
            <input type="text" name="author_Name" max="40" required><br>

            <label>&nbsp;</label>
            <input type="submit" id="button" value="Add Author"><br>
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