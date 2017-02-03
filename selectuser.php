<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");

if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $query = "SELECT id FROM users WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $id);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    // TODO: Check for == 1 instead of > 0 when page names become unique.
    $pageExists = $statement->num_rows == 1;
    if ($pageExists)
    {
        myRefresh("edituser.php?id=$id");
    }
    else
    {
        echo "<div class='eror'>כישלון באיתור הדף הרצוי או בפעולה שנשלחה<br>נסה שנית</div>";
        myRefresh("selectitem.php");
    }
}
?><br>
<?php if (is_admin()){ ?>
<div class="containers">
    <h2>Edit User</h2>
    <form action="selectuser.php" method="post">

            <ol>
                <li>
                    <label for="id">users name:</label>
                    <select id="id" name="id">
                        <option value="0">--בחר משתמש עריכה--</option>
                        <?php
                        $statement = $databaseConnection->prepare("SELECT id, username FROM users");
                        $statement->execute();

                        if($statement->error)
                        {
                            die("Database query failed: " . $statement->error);
                        }

                        $statement->bind_result($id, $username);
                        while($statement->fetch())
                        {
                            echo "<option value=\"$id\">$username</option>\n";
                        }
                        ?>
                    </select>
                </li>
            </ol>
            <input type="submit" name="submit" value="Edit" />
    </form>
    <br/>
    <a href="index.php">Cancel</a>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php }else{
  ?><div class="eror">אין לך מספיק הרשאות בכדי לגשת לעמוד זה</div><?
}
 include ("Includes/footer.php"); ?>
