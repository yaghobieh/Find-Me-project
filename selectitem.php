<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");

if (isset($_POST['submit']))
{
    $itemId = $_POST['itemId'];
    $query = "SELECT itemid FROM items WHERE itemid = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $itemId);
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
        myRefresh("edititem.php?itemid=$itemId");
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
    <h2>Edit Page</h2>
    <form action="selectitem.php" method="post">

            <ol>
                <li>
                    <label for="itemId">Title:</label>
                    <?php include ("Includes/editStore.php");
                        makeSelectionPlatform();
                    ?>
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
