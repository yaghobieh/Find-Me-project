<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");

?>

<br><br>
    <div class="title_tb">
<?php

        $pageNumber = $_GET['page'];
        $pageid = $_GET['pageid'];


        $query = 'SELECT menulabel, content FROM pages WHERE id = ? LIMIT 1';
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('s', $pageid);
        $statement->execute();
        $statement->store_result();
        if ($statement->error)
        {
            die('Database query failed: ' . $statement->error);
        }

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($menulabel, $content);
            $statement->fetch();
            ?>
              <div class="nameTop" id="getInfo">
                <div class="inNameRight">
                  <?php echo "$menulabel"; ?> |
                </div>
                <div class="inNameCenter">
                  <u>תתי מוצרים:</u> <?php echo "$content"; ?>
                </div>
                  <?php
                  $query = 'SELECT COUNT("itemid") FROM items WHERE cid = ?';
                  $statement = $databaseConnection->prepare($query);
                  $statement->bind_param('s', $pageid);
                  $statement->execute();
                  $statement->store_result();
                  if ($statement->error)
                  {
                      die('Database query failed: ' . $statement->error);
                  }

                  if ($statement->num_rows == 1)
                  {
                    $statement->bind_result($countInThisPage);
                    $statement->fetch();
                    ?><div class="inNameCenter"><u>מוצרים בעמוד זה:</u> <?php echo $countInThisPage; ?></div><?
                  }
                  ?>
                  <div class="inNameCenter">
                    <a href="#" data-showpopup='5' id="reportThisPage">דווח</a> &#x2024; <a href="#" data-showpopup='6' id="updateToPage">הרשם כמנוי</a> &#x2024; <?php if (is_admin()) { ?><a href="additem.php">הוסף מוצר חדש</a> &#x2024; <a href="selectpagetoedit.php">ערוך עמוד זה</a>
                    <?}?>
                  </div>
                </div>
              </div>
            <?php
        }
        else
        {
            echo "<div class='eror'>התרחשה שגיאה בלתי צפוייה</div>";
        }

        $statement = $databaseConnection->prepare("SELECT Cid, name, price, Linfo, itemid, imgFront, dateOfAdd FROM items ORDER BY itemid DESC");
        $statement->execute();
          if($statement->error)
          {
            die("Database query failed: " . $statement->error);
           }
           $statement->bind_result($Cid, $name, $price, $Linfo, $itemid, $imgFront, $dateOfAdd);
           while($statement->fetch())
           {
             if ( $Cid == $pageid ) {

                ?>
                  <div class="itemsVisability">
                    <div class="itemsVisabilityPic">
                        <img src='<?php echo $imgFront?>'>

                    </div>
                    <div class="itemsVisabilityTextAbout">
                        <?php echo "<div class='fontTitle'><a href=\"item.php?itemid=$itemid\">$name</a></div><br>";
                        ?>
                      <?php echo "$Linfo"; ?><br>
                    </div>
                    <div class="sideLedt">
                      <div class="itemsVisabilityPriceSide">
                        <br>
                        <center><?php echo "$price"; ?></center>
                        <input type="button" value="השוואת מחירים >>" name="comparisonPrice" onclick="window.location.href='\item.php?itemid=<?php echo $itemid; ?>'">
                        <br>
                        <u>הצטרף:</u> <?php echo $dateOfAdd; ?>
                      </div>
                    </div>
                  </div>
                <?php
          }
        }

?>
</div>
    <div class="mrDuff">
        <div class="info">
            <?php
        ?>
        </div>
    </div>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
 ?>
 <div class="overlay-content popup5">
   <div class="distribution" id="distribution">
     <h1><?php echo ReportItem;?></h1>
     <hr>
     <form action=" " method="post">
       <input type="text" name="userName" value="<?php echo $_SESSION['username']; ?>">
       <input type="text" name="pageName" value="<?php echo $menulabel; ?>">
       <textarea maxlength="300" name="contents">ברצוני לדווח על: </textarea>
       <hr>
       <button name="resport" id="report">דווח!</button>
             <?php include ("resportPage.php"); ?>
   </form>
   </div>
 </div>

 <div class="overlay-content popup6">
   <div class="distribution" id="distribution">
     <h1><?php echo regForUpdate;?></h1>
     <hr>
     <form action="" method="post">
       <input type="text" name="userName" value="<?php echo $_SESSION['username']; ?>">
       <input type="text" name="pageName" value="<?php echo $menulabel; ?>">
       <?php date_default_timezone_set('Asia/Jerusalem'); ?>
       <input type="hidden" name="date" value="<?php echo date('m/d/Y', time());?>">
       <hr>
       <button name="regForUpdate" id="regForUpdate">דווח!</button>
       <?php include("regForUpdate.php"); ?>
   </form>
   </div>
 </div>
 <script>
  document.title = '<?php echo $menulabel; ?>';
</script>
