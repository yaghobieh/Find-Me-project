<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");

    if (isset($_POST['submit']))
    {
        $storeIdForDelete = $_POST['name'];
        $query = "DELETE FROM stores WHERE id = ?";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('d', $storeIdForDelete);
        $statement->execute();
        $statement->store_result();

        if ($statement->error)
        {
            die('Database query failed: ' . $statement->error);
        }
        $deletionWasSuccessful = $statement->affected_rows > 0 ? true : false;
        if ($deletionWasSuccessful)
        {
          echo "<div class='eror'>הפעולה בוצעה בהצלחה</div>";
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
    <h2>Delete Store</h2>
    <form action="" method="post">

            <ol>
                <li>

                    <select id="name" name="name">
                        <option value="0">בחר חנות</option>
                            <?php
                                $statement = $databaseConnection->prepare("SELECT id, title FROM stores");
                                $statement->execute();

                                if($statement->error)
                                {
                                    die("Database query failed: " . $statement->error);
                                }

                                $statement->bind_result($storeId, $storeName);
                                while($statement->fetch())
                                {
                                    echo "<option value=\"$storeId\">$storeName</option>\n";
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
<?php }else{
      echo "<div class='eror'>אין לך מספיק הרשאות בכדי שתוכל להשתמש בעמוד זה</div>";
}include ("Includes/footer.php"); ?>

<script>
  document.title = '<?php echo DELETֹ_STORE; ?>';
</script>
