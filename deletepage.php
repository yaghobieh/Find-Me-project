<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");
    confirm_is_admin();

    if (isset($_POST['submit']))
    {
        $pageId = $_POST['menulabel'];
        $query = "DELETE FROM pages WHERE id = ?";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('d', $pageId);
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
    <h2>Delete Page</h2>
    <form action="deletepage.php" method="post">

            <ol>
                <li>

                    <select id="menulabel" name="menulabel">
                        <option value="0">בחר עמוד</option>
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
  document.title = '<?php echo DELETֹ_PAGE; ?>';
</script>
