<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");

    if (isset($_POST['submit']))
    {
        $itemId = $_POST['name'];
        $query = "DELETE FROM items WHERE itemid = ?";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('d', $itemId);
        $statement->execute();
        $statement->store_result();

        if ($statement->error)
        {
            die('Database query failed: ' . $statement->error);
        }

        // TODO: Check for == 1 instead of > 0 when page names become unique.
        $deletionWasSuccessful = $statement->affected_rows > 0 ? true : false;
        if ($deletionWasSuccessful)
        {
          echo "<div class='eror'>עמוד זה נמחק בהצלחה!<br>הינך מועבר לעמוד הראשי</div>";
            ?><script>parent.history.back();</script><?
        }
        else
        {
            echo "<div class='eror'>התרחשה שגיאה בדוק את העמוד אותו אתה מנסה למחוק</div>";
        }
    }
?>
<?php if (is_admin()){ ?>
<div class="containers">
    <h2>Delete Item</h2>
    <form action="deleteitem.php" method="post">

            <ol>
                <li>

                    <select id="name" name="name">
                        <option value="0">בחר עמוד</option>
                            <?php
                                $statement = $databaseConnection->prepare("SELECT itemid, name FROM items");
                                $statement->execute();

                                if($statement->error)
                                {
                                    die("Database query failed: " . $statement->error);
                                }

                                $statement->bind_result($itemId, $name);
                                while($statement->fetch())
                                {
                                    echo "<option value=\"$itemId\">$name</option>\n";
                                }
                            ?>
                    </select>
                </li>
            </ol><br>
            <input type="submit" name="submit" value="מחק עמוד זה" />
            <p>
                <a href="index.php">חזור אחורה</a>
            </p>
    </form>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php  } else{
            echo "<div class='eror'>אין לך מספיק הרשאות בכדי שתוכל להשתמש בעמוד זה</div>";
        }include ("Includes/footer.php"); ?>

<script>
  document.title = '<?php echo DELETֹ_ITEM; ?>';
</script>
