<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
include("Includes/header.php");

$pageId = null;
$menulabel = null;
$content = null;
if(isset($_GET['id']))
{
    $pageId = $_GET['id'];
    $query = "SELECT menulabel, content, setIt, idBlock, division_num, imgFront FROM pages WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $pageId);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    $pageExists = $statement->num_rows == 1;
    if ($pageExists)
    {
        $statement->bind_result($menulabel, $content, $setIt, $idBlock, $division_num, $imgFront);
        $statement->fetch();
    }
    else
    {
        header("Location: index.php");
    }
}
else if (isset($_POST['submit']))
{
    $pageId = $_POST['pageId'];
    $menulabel = $_POST['menulabel'];
    $content = $_POST['content'];
    $setIt = $_POST['setIt'];
    $idBlock = $_POST['idBlock'];
    $division_num = $_POST['division_num'];

    $query = "UPDATE pages SET menulabel = ?, content = ?, setIt= ?, idBlock = ?, division_num= ? WHERE Id = ?";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ssssss', $menulabel, $content, $setIt, $idBlock, $division_num, $pageId);
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

        $filename = "documents/pageCahnges.txt";
        $handle = fopen($filename, "a");
        fwrite($handle, 'Page id: ' );
        fwrite($handle, $pageId );
        fwrite($handle, 'Edit date: ' );
        fwrite($handle,  $date);
        fwrite($handle, 'new name: ' );
        fwrite($handle, $menulabel );
        fwrite($handle, 'new info: ' );
        fwrite($handle, $content . PHP_EOL);
        fclose($handle);
        echo "<div class='eror'>עמוד זה נערך כראוי, תודה רבה!</div>";
        myRefresh("javascript:history.back()");
    }
    else
    {
        echo "<div class='eror'>אופס התרחשה שגיאה בלתי צפוייה</div>";
        myRefresh('selectpagetoedit.php');
    }
}
else
{
    myRefresh('index.php');
}
?>
<br>
<?php if (is_admin()){ ?>
<div class="containers">
    <h1>ערוך קטגוריה</h1>
    <p>תמונת פנים:</p><br>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" value="<?php echo $pageId; ?>" name="pageid" >
      <input type="file" name="image" />
      <input type="submit" name="upload" value="העלאת תמונה חדשה"/>
     <?php include("uploadPage.php"); ?>
   </form><br>
    <form action="editpage.php" method="post">

                <ol>
                    <li>
		      	            <input type="hidden" id="pageId" name="pageId" value="<?php echo $pageId; ?>" />
                        <p>ערוך כותרת עמוד</p>
                        <input type="text" name="menulabel" value="<?php echo $menulabel; ?>" id="menulabel" />
                    </li>
                    <li>
                      <h4>יופיע בסרגל כלים:</h4>
                      <div class="input-group" name="setIt">
                        <select name="setIt">
                          <option selected="0" value="<?php echo $setIt; ?>"><?php echo $setIt; ?></option>
                          <option value="true">כן</option>
                          <option value="false">לא</option>
                        </select>
                      </div>
                    </li>
                  <li>
                    <h4>יופיע באינדקס קטגרויות:</h4>
                      <div class="input-group" name="division_num">
                        <select name="division_num">
                          <option selected="0" value="<?php echo $division_num; ?>"><?php echo $division_num; ?></option>
                          <option value="true">כן</option>
                          <option value="false">לא</option>
                        </select>
                      </div>
                    </li>
                    <li>
                        <p>תוכן עמוד</p><br>
                        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
                        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
                        <textarea name="content" id="content"><?php echo $content; ?></textarea>
                    </li>
                </ol>
                <input type="submit" name="submit" value="שלח עריכה זו" />
                <p>
                    <a href="index.php">חזור לעמוד ראשי</a>
                </p>

    </form>
</div>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php }else{
  ?><div class="eror">אין לך מספיק הרשאות בכדי לגשת לעמוד זה</div><?
}
 include ("Includes/footer.php"); ?>

 <script>
   document.title = '<?php echo EDIT_PAGE. " " .$menulabel ; ?>';
 </script>
