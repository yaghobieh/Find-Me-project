<?php
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php");
    require_once ("Includes/connectDB.php");
    include("Includes/header.php");
    confirm_is_admin();

    if (isset($_POST['submit']))
    {
        $pageId = $_POST['pageId'];
        $queryPages = "SELECT Id FROM pages WHERE id = ?";
        $statement = $databaseConnection->prepare($queryPages);
        $statement->bind_param('d', $pageId);
        $statement->execute();
        $statement->store_result();

        $name = $_POST['name'];
        $Linfo = $_POST['Linfo'];
        $price = $_POST['price'];
        $Cid = $_POST['pageId'];
        $imgFront = $_POST['imgFront'];
        $dateOfAdded = $_POST['addTime'];

        $sql = "SELECT * FROM items where name = '$name'";
        $result = $databaseConnection->query($sql);
        $numRows =  $result->num_rows;
        if ($numRows <> 0)
        {
            echo "<div class='eror'>עמוד זה כבר קיים במערכת</div><br>";
            myRefresh("additem.php");
            die();
        }else
        {
        $query = "INSERT INTO items (name, Linfo, price, Cid, imgFront, dateOfAdd) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ssssss', $name, $Linfo, $price, $Cid, $imgFront, $dateOfAdded);
        $statement->execute();
        $statement->store_result();
      }
        if ($statement->error)
        {
            die('Database query failed: ' . $statement->error);
        }

        $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful)
        {
          myRefresh("selectitem.php");
        }
        else
        {
          echo "<div class='eror'>אופס! ישנה טעות במילוי הטופס או באחד הפרטים נסה שוב</div>";
          myRefresh ("additem.php");
        }
    }
?>
<?PHP
  if (is_admin()){ ?>
<div class="Editors" dir="rtl">
    <h2>הוספת מוצר</h2>
        <form action="additem.php" method="post">
            <ol>
                <li>
                    <label for="name">שם מוצר:</label>
                    <?php date_default_timezone_set('Asia/Jerusalem'); ?>
                    <input type="hidden" name="addTime" value="<?php echo date('m/d/Y', time());?>">
                    <input type="text" name="name" value="" id="name" />
                </li>
                <div class="col-half">
                  <h4>בחור קטגורית מוצר:</h4>
                  <div class="input-group" name="pageId">
                    <select id="pageId" name="pageId">
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
                  </div>
                </div>
                <div class="col-half">
                  <h4>מחיר מומלץ!</h4>
                  <div class="input-group" name="price">
                    <input type="text" name="price" value="" id="price" />
                  </div>
                </div>
                <li>
                    <label for="imgFront">בחר תמונה</label>
                    <input type="text" name="imgFront" value="" id="imgFront" />
                </li>
                <li>
                    <label for="Linfo">קצת מידע על המוצר:</label>
                    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
                    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
                    <textarea name="Linfo" id="content"></textarea>
                </li>
                <br>
            <input type="submit" name="submit" value="צור מוצר" />
            <p>
                <a href="index.php">Cancel</a>
            </p>
          </ol>
    </form>
</div>
<?PHP }
else
      echo "<div class='eror'>אינך בהרשאות המתאימות בכדי להוסיפך עמוד</div>"; ?>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>
<script>
  document.title = '<?php echo CREATE_NEWITEM; ?>';
</script>
