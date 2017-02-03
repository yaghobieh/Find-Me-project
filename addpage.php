<?php
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php");
    require_once ("Includes/connectDB.php");
    include("Includes/header.php");
    confirm_is_admin();

    if (isset($_POST['submit']))
    {
        $menulabel = $_POST['menulabel'];
        $content = $_POST['content'];
        $setIt = $_POST['setIt'];
        $division_num = $_POST['division_num'];
        $imgFront = $_POST['imgFront'];

        $sql = "SELECT * FROM pages where menulabel = '$menulabel'";
        $result = $databaseConnection->query($sql);
        $numRows =  $result->num_rows;
        if ($numRows <> 0)
        {
            echo "<div class='eror'>עמוד זה כבר קיים במערכת</div><br>";
            myRefresh("addpage.php");
            die();
        }else
        {
        $query = "INSERT INTO pages (menulabel, content, setIt, division_num, imgFront)
                              VALUES (?, ?, ?, ?, ?)";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('sssss', $menulabel, $content, $setIt, $division_num, $imgFront);
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
            echo "<div class='eror'>תודה עמוד זה נוצר בהצלחה!</div><br>";
            myRefresh ("index.php");
        }
        else
        {
              echo "<div class='eror'>אופס! ישנה טעות במילוי הטופס או באחד הפרטים נסה שוב</div>";
              myRefresh ("addpage.php");
        }
    }
?>
<?PHP
  if (is_admin()){ ?>
    <br>
 <div class="Editors" dir="rtl">
    <center><h2>הוסף עמוד חדש</h2></center>
        <form action="addpage.php" method="post">
          <ol>
                <li>
                    <p>כותרת עמוד:</p>
                    <input type="text" name="menulabel" value="" id="menulabel" />
                </li>

                <li>
                  <h4>יופיע בסרגל כלים:</h4>
                  <div class="input-group">
                    <select name="setIt">
                      <option value="true">כן</option>
                      <option value="false">לא</option>
                    </select>
                  </div>
                </li>
              <li>
                <h4>יופיע באינדקס קטגרויות:</h4>
                  <div class="input-group">
                    <select name="division_num">
                      <option value="true">כן</option>
                      <option value="false">לא</option>
                    </select>
                  </div>
                </li>
                <li>
                  <h4>תמונת ראשית:</h4>
                      <input type="text" name="imgFront" value="" id="imgFront" />
                  </li>
                <li>
                    <p>מידע עמוד:</p><br>
                    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
                    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
                    <textarea name="content" id="content"></textarea>
                </li>
            </ol>
            <input type="submit" name="submit" value="צור עמוד חדש" />
            <p>
                <a href="index.php">חזור אחורה</a>
            </p>
    </form>
    <?PHP }
    else
          echo "<div class='eror'>אינך בהרשאות המתאימות בכדי להוסיפך עמוד</div>"; ?>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>

<script>
  document.title = '<?php echo CREATE_NEWPAGE; ?>';
</script>
