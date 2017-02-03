<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");
    include("Includes/responseCenterItem.php");

    $pageNumber = $_GET['page'];
    $itemid = $_GET['itemid'];

    if (!isset($_GET['page'])){
      myRefresh("item.php?itemid=$itemid&page=1");
    }


      $per_page = ITEMֹLIMITֹPAGE;
      $sql = "SELECT COUNT('item_id') FROM store_items";
      $result = $databaseConnection->query($sql);
      $pages = $result/ $per_page;

      $statement = $databaseConnection->prepare($sql);
      $statement->execute();
      $statement->store_result();

      if ($statement->num_rows == ONE)
      {
          $statement->bind_result($pages);
          $statement->fetch();
      }

    $userWrite = $_GET['userWrite'];
    $query = 'SELECT name, Linfo, imgFront FROM items WHERE itemid = ? LIMIT 1 ';
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('s', $itemid);
    $statement->execute();
    $statement->store_result();
    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    if ($statement->num_rows == ONE)
    {
        $statement->bind_result($name, $Linfo, $imgFront);
        $statement->fetch();
        ?>
          <div class="itemsVisability" id="itemsVisability">
            <div class="itemsVisabilityTextAbout-Other">
                <div class='fontTitle'><?php echo $name?>
                </div>
                <a href="reponseItems.php?itemid=<?php echo $itemid; ?>">קרא/י תגובות</a><br><br>
                <?php echo "$Linfo"; ?><br>
                <?
                $query = "SELECT COUNT('response_id') FROM response WHERE itemID = ?";
                $statement = $databaseConnection->prepare($query);
                $statement->bind_param('s', $itemid);
                $statement->execute();
                $statement->store_result();
                $statement->bind_result($counterOfResponseForThisItem);
                while ($statement->fetch()) {
                }
                if ( $counterOfResponseForThisItem >= 0) {
                  ?><font color="#287aff" size="6px">&#9733;</font><?
                }
                if ( $counterOfResponseForThisItem > 3) {
                  ?><font color="#287aff" size="6px">&#9733;</font><?
                }
                if ( $counterOfResponseForThisItem > 5 ){
                  ?><font color="#287aff" size="6px">&#9733;</font><?
                }
                if ( $counterOfResponseForThisItem > 15 ){
                  ?><font color="#287aff" size="6px">&#9733;</font><?
                }
                if ( $counterOfResponseForThisItem > 30 ){
                  ?><font color="#287aff" size="6px">&#9733;</font><?
                }
                if ( $counterOfResponseForThisItem > 40 ){
                  ?><font color="#287aff" size="6px">&#9733;</font><?
                }
                ?>
                <br>
                 <a href="#" data-showpopup='3' id="reportItems">דווח</a> &#x2024; <a href="#" data-showpopup='4' id="updateToItem">הרשם כמנוי</a>
            </div>
            <div class="items-side">
              <img src="<?php echo $imgFront; ?>">
            </div>
          </div>
          </div>
        <?


        $numOfCounter = $pages / $per_page;
        $startPage = (($pageNumber- ONE) * $per_page);

        ?><center><div class="stores_block"><?
        $sql = "SELECT * FROM store_items WHERE item_id = $itemid ORDER BY price LIMIT $startPage, $per_page";
        $result = $databaseConnection->query($sql);
            if ($result->num_rows > ZERO) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  include("getStoreInItem.php");
                }
            }
        ?></div></center> <?
        ?></div><div class="pages"><?
        for ( $numberBeginnerPage = ONE ; $numberBeginnerPage <= $numOfCounter ; $numberBeginnerPage++){
          ?><a href="item.php?itemid=<?php echo $itemid;?> &page=<?php echo $numberBeginnerPage; ?>"><?php echo $numberBeginnerPage;?></a><?
        }
        ?></div><?

        }
        else
        {
            echo "<div class='eror'>עמוד זה אינו קיים</div>";
        }
        if (logged_on()) {
          ?>
<br>
    <center><a id="displayText" href="javascript:toggle();">שלח תגובה</a></center>
    <div id="toggleText" style="display: none">
    <div class="containers">
        <form method="post" action=" ">
          <input type="text" id="title" name="title" maxlength=15  placeholder="Title" required=""><br /><br>
          <input type="text" id="subtitle" name="subtitle" maxlength="20" placeholder="Sub title" ><br />
          <br> <br /><textarea name="contents" placeholder="contents" required=""></textarea><br /><br>
          <input type="submit" value="שלח תגובה" name="submit" />
        </form>
      </div></div>
      <br><br>
    <?PHP
    }
    ?>
</div>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->

<div class="overlay-content popup3">
  <div class="distribution" id="distribution">
    <h1><?php echo ReportItem;?></h1>
    <hr>
    <form action="" method="post">
      <input type="text" name="userName" value="<?php echo $_SESSION['username']; ?>">
      <input type="text" name="pageName" value="<?php echo $name; ?>">
      <textarea maxlength="300" name="contents">ברצוני לדווח על: </textarea>
      <hr>
      <button name="resport" id="report">דווח!</button>
  </form>
  </div>
</div>

<div class="overlay-content popup4">
  <div class="distribution" id="distribution">
    <h1><?php echo regForUpdate;?></h1>
    <hr>
    <form action="" method="post">
      <input type="text" name="userName" value="<?php echo $_SESSION['username']; ?>">
      <input type="text" name="pageName" value="<?php echo $name; ?>">
      <?php date_default_timezone_set('Asia/Jerusalem'); ?>
      <input type="hidden" name="date" value="<?php echo date('m/d/Y', time());?>">
      <hr>
      <button name="regForUpdate" id="regForUpdate">הרשם כמנוי</button>
  </form>
  </div>
</div>
<?php
    include ("resportPage.php");
    include("regForUpdate.php");
    include ("Includes/footer.php");
?>
<script>
  document.title = '<?php echo $name; ?>';
</script>
