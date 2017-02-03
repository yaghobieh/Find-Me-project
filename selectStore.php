<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");

  if (isset($_POST['submit'])){
      $storeName = $_POST['storeName'];

      $query = "SELECT id FROM stores WHERE title = '$storeName' ";
      $statement = $databaseConnection->prepare($query);
      $statement->execute();
      $statement->store_result();

      if ($statement->error)
      {
          die('Database query failed: ' . $statement->error);
      }

      $pageExists = $statement->num_rows == 1;
      if ($pageExists)
      {
          $statement->bind_result($storeId);
          $statement->fetch();
          myRefresh("stores.php?storeid=$storeId");
      }else{
        echo 'no';
      }

  }else{
    echo "<div class='eror'>כישלון באיתור הדף הרצוי או בפעולה שנשלחה<br>נסה שנית</div>";
  }
?><br>
<?php if (is_admin()){ ?>
<div class="containers">
    <h2>בחר חנות: </h2>
    <form action="" method="post">

            <ol>
                <li>
                    <label for="pageId">כותרת:</label>
                    <select id="storeName" name="storeName">
                        <option value="0">--בחור שם חנות--</option>
                        <?php
                        $statement = $databaseConnection->prepare("SELECT title FROM stores");
                        $statement->execute();

                        if($statement->error)
                        {
                            die("Database query failed: " . $statement->error);
                        }

                        $statement->bind_result($storeName);
                        while($statement->fetch())
                        {
                            echo "<option value=\"$storeName\">$storeName</option>\n";
                        }
                        ?>
                    </select>
                </li>
            </ol>
            <input type="submit" name="submit" value="Select" />
    </form>
    <br/>
    <a href="index.php">Cancel</a>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php }else{
  ?><div class="eror">אין לך מספיק הרשאות בכדי לגשת לעמוד זה</div><?
}
 include ("Includes/footer.php"); ?>
