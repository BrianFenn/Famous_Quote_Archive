<?php include '../view/header.php'; 
require_once('../util/valid_admin.php');
?>

<main>
    <h1 style="color: blue">Famous Quote Administrators List</h1>
    <?php if ( sizeof($users) == 0) { 
    
    echo "There are currently 0 Administrators, you may add them <a id ='plain' href='?action=register_user'>here</a>" . "<br><br>";
} else { ?>
    
    <section>
        <table>
            <tr>
                <th colspan="2">Name</th>
            </tr>        
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="remove_user">
                        <input type="hidden" name="user_id"
                            value="<?php echo $user['user_id']; ?>"/>
                        <input type="submit" value="Remove" id="button_delete" class="button red" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    </section>


    <section>
        <h2 style=""><a href='admin-register.php'>Add New User</a></h2>
        
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

