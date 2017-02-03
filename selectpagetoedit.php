<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");

if (isset($_POST['submit']))
{
    $pageId = $_POST['pageId'];
    $query = "SELECT Id FROM pages WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $pageId);
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
        myRefresh("editpage.php?id=$pageId");
    }
    else
    {
        echo "<div class='eror'>כישלון באיתור הדף הרצוי או בפעולה שנשלחה<br>נסה שנית</div>";
    }
}
?><br>
<?php if (is_admin()){ ?>
<div class="containers">
    <h2>בחר קטגורייה: </h2>
    <form action="selectpagetoedit.php" method="post">

            <ol>
                <li>
                    <label for="pageId">כותרת:</label>
                    <select id="pageId" name="pageId">
                        <option value="0">--בחר קטגורייה--</option>
                        <?php
                        $statement = $databaseConnection->prepare("SELECT id, menulabel FROM pages");
                        $statement->execute();

                        if($statement->error)
                        {
                            die("Database query failed: " . $statement->error);
                        }

                        $statement->bind_result($id, $menulabel);
                        while($statement->fetch())
                        {
                            echo "<option value=\"$id\">$menulabel</option>\n";
                        }
                        ?>
                    </select>
                </li>
            </ol>
            <input type="submit" name="submit" value="Edit" />
    </form>
    <br/>
    <a href="index.php">חזור אחורה</a>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php }else{
  ?><div class="eror">אין לך מספיק הרשאות בכדי לגשת לעמוד זה</div><?
}
 include ("Includes/footer.php"); ?>
