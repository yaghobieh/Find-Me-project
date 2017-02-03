<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
include("Includes/header.php");

$itemId = null;
$name = null;
$Linfo = null;
$price = 0;
if(isset($_GET['itemid']))
{
    $itemId = $_GET['itemid'];
    $query = "SELECT name, Linfo, price, imgFront, cid, commonKeys FROM items WHERE itemid = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $itemId);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    $pageExists = $statement->num_rows == 1;
    if ($pageExists)
    {
        $statement->bind_result($name, $Linfo, $price, $imgFront, $cid, $commonKeys);
        $statement->fetch();
    }
    else
    {
      echo "<div class='eror'>עמוד זה נערך כראוי, תודה רבה!</div>";
      myRefresh("selectitem.php");
    }
}
else if (isset($_POST['submit']))
{
    $itemId = $_POST['itemId'];
    $name = $_POST['name'];
    $Linfo = $_POST['Linfo'];
    $price = $_POST['price'];
    $pageId = $_POST['pageId'];
    $commonKeys = $_POST['commonKeys'];

    $query = "UPDATE items SET name = ?, Linfo = ?, price= ?, commonKeys = ?, cid= ? WHERE itemid = ?";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('sssssd', $name, $Linfo, $price,  $commonKeys, $pageId, $itemId);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful)
    {
        date_default_timezone_set('Asia/Jerusalem');
        $date = date('m/d/Y h:i:s a', time());

        $filename = "documents/itemCahnges.txt";
        $handle = fopen($filename, "a");
        fwrite($handle, 'item id: ' );
        fwrite($handle, $itemId );
        fwrite($handle, 'Edit date: ' );
        fwrite($handle,  $date);
        fwrite($handle, 'new name: ' );
        fwrite($handle, $name );
        fwrite($handle, 'new info: ' );
        fwrite($handle, $Linfo );
        fwrite($handle, 'new price: ' );
        fwrite($handle, $price . PHP_EOL);
        fclose($handle);

        echo "<div class='eror'>עמוד זה נערך כראוי, תודה רבה!</div>";
    }
    else
    {
        echo "<div class='eror'>התרחשה שגיאה בלתי צפוייה</div>";
        myRefresh('selectitem.php');
    }
}
else
{
  echo "<div class='eror'>עמוד זה נערך כראוי, תודה רבה!</div>";
}
?>
<?php if (is_admin()){ ?>
<div class="containers">
    <h1>Edit Item</h1>
        <p>תמונת זיהוי</p><br>
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" value="<?php echo $itemId; ?>" name="itemid" >
          <input type="file" name="image" />
          <input type="submit" name="upload" value="העלאת תמונה חדשה"/>
         <?php include("uploadItem.php"); ?>
       </form><br>
    <form action="edititem.php" method="post">
                <ol>
                    <li>
		      	            <input type="hidden" id="itemId" name="itemId" value="<?php echo $itemId; ?>" />
                        <p>ערוך כותרת עמוד</p>
                        <input type="text" name="name" value="<?php echo $name; ?>" id="name" />
                    </li>
                    <li>
                        <p>מפתחת מוצר</p><br>
                        <input type="text" name="commonKeys" value="<?php echo $commonKeys; ?>" id="imgFront"/>
                    </li>
                    <br>
                    <div class="col-half">
                      <h4>בחור קטגורית מוצר:</h4>
                      <div class="input-group" name="pageId">
                        <select id="pageId" name="pageId">
                            <option value="<?php echo $cid; ?>"><?php echo $cid; ?></option>
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
                      <div class="input-group" name="setIt">
                        <input type="text" name="price" value="<?php echo $price; ?>" id="price"/>
                      </div>
                    </div>
                    <li>
                        <p>תוכן המוצר</p><br>
                        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
                        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
                        <textarea name="Linfo" id="Linfo"><?php echo $Linfo; ?></textarea>
                    </li>
                </ol>
                <input type="submit" name="submit" value="שלח עריכה זו" />
                <p>
                    <a href="index.php">חזור לעמוד ראשי</a>
                </p>

    </form>
</div>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php  } else{
            echo "<div class='eror'>אין לך מספיק הרשאות בכדי שתוכל להשתמש בעמוד זה</div>";
        }include ("Includes/footer.php"); ?>

<script>
  document.title = '<?php echo EDIT_ITEM . " " .$name; ?>';
</script>
