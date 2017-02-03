<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");
Include("Includes/responseCeneterStores.php");


  $storeTitle = $_GET['storename'];

  $query = "SELECT title, logo, sub_info, phoneNumber, manager, email, webAdress, adress, responsecounter FROM stores WHERE title = ?";
  $statement = $databaseConnection->prepare($query);
  $statement->bind_param('s', $storeTitle);
  $statement->execute();
  $statement->store_result();
  if ($statement->error)
  {
      die('Database query failed: ' . $statement->error);
  }

  if ($statement->num_rows == 1)
  {
    $statement->bind_result($title, $logo, $sub_info, $phoneNumber, $manager, $email, $wabAdress, $adress, $responsecounter);
    $statement->fetch();
    ?>
        <div class="my-store">
          <div class="logo-init"><img src="<?php echo $logo; ?>"></div>
            <div class="info-store">
              <div class="title-store"><?php echo $title; ?></div>
            <?php echo $sub_info; ?><br>
            <?
            if ( $responsecounter >= 1) {
              ?><span>&#9733;</span><?
            }
            if ( $responsecounter > 3) {
              ?><span>&#9733;</span><?
            }
            if ( $responsecounter > 5 ){
              ?><span>&#9733;</span><?
            }
            if ( $responsecounter > 15 ){
              ?><span>&#9733;</span><?
            }
            if ( $responsecounter > 30 ){
              ?><span>&#9733;</span><?
            }
            if ( $responsecounter > 40 ){
              ?><span>&#9733;</span><?
            }
            ?><br><br>
            <span><u>מיקום: </u> <?php echo $adress ?></span><br>
            <span><u>מספר טלפון:</u> <?php echo $phoneNumber ?></span><br>
            <span><u>מייל:</u> <?php echo $email ?></span><br>
            <span><u>כתובת אתר:</u><a href="http://<?php echo $wabAdress ?>" target="_blank"><?php echo $wabAdress ?></a></span><br>
            <span><u>משתתף גם: </u>
              <?php
              $sql = "SELECT * FROM store_items WHERE store_name = '$storeTitle' LIMIT 5";
              $result = $databaseConnection->query($sql);
                  if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo $row['item_name'] .  ' &#x2024;';
                      }
                  }
                ?>
            </span><br>
            <a href="#" data-showpopup='3' id="reportItems">דווח</a> &#x2024; <a href="#" data-showpopup='4' id="updateToItem">הרשם כמנוי</a><br>
            <br><br>
          </div>

            <div class="info-store-map" id="map">
              <img width="400" src="http://www.mapquestapi.com/staticmap/v4/getplacemap?key=RuE6xzLg2ip14sXGbmLufORCA19hXLWb&location=<?php echo $adress; ?>&size=400,300&type=map&zoom=15&imagetype=gif&scalebar=false&showicon=yellow-1" alt="MapQuest Map of tel aviv, israel">
          </div>
        </div>

    <?
  }

    ?>
  <br>
  <?

    $sql = "SELECT * FROM response_store WHERE storename = '$storeTitle' ";
    $result = $databaseConnection->query($sql);
      if ($result->num_rows > 0) {

          // output data of each row
          while($row = $result->fetch_assoc()) {
            if ( $row["publicity"] == "true") {
            ?>
            <div class="responseBy">
              <div class="responseByInside">
                <div class="profileInfo">
                  <?php //Include("getUserPic.php");
                    //$getPictureReturn = getUserPicture($row['username']);
                    $user = $row['username'];
                    $query = "SELECT userPic FROM users WHERE username = ?";
                    $statement = $databaseConnection->prepare($query);
                    $statement->bind_param('s', $user);
                    $statement->execute();
                    $statement->store_result();
                    $statement->bind_result($userPic);
                    while ($statement->fetch()) {
                            ?><div class="logoLittle"><img src="<?php echo $userPic; ?>"></div><?
                    }

                  ?>

                  <div class="infoWritter">
                  שם: <a href='profile.php?username=<?php echo $row['username']; ?>' target='_blank'><?php echo $row['username']; ?></a><br><br>
                  תאריך: <?php echo $row['dateOfPublicity']; ?></a><br><br>
                   <a href="summeryResponse.php?username=<?php echo $row['username']; ?>">צפה בתגובות משתמש זה</a>
                </div>
              </div>
                <span>
                <b>שירות: </b> <font size="5px" color="blue"><?php echo $row['gradeOfServise']; ?></font><br>
                <b>קלות הזמנה: </b> <font size="4px" color="blue"><?php echo $row['gradeOfEasyOrder']; ?></font>
               </span>
                <div><br>

                    <div class="like">
                    <form method="post" action=" ">
                          <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                            <?php
                            if (logged_on()) { ?> <button type="submit" name="like">👍</button> <?}
                            else echo 'מספר המתעניינים במידע זה '?>
                        </div>
                        <span><?php echo $row['likeCounter']; ?></span>
                        <div class="unlike">
                        <?php if (logged_on()) {
                        ?>  <button type="submit" name="unlike">👎</button><?}?>
                        </div>
                      <span><?php echo $row['unlikeCounter']; ?></span>
                  </form>
                  <?PHP
                  Include("likeThisResponse.php"); ?>
                </div>
              </div>
              <div class="responseByInsideCenter">
                <p>תיאור חווית הקנייה:</p><br>
                <b><?php echo $row["title"]; ?></b><br><br>
                  <p id="alignIn-responseByInsideCenter"><?php echo $row['contents']; ?></p>
              </div>
            </div>
          </div>
            <?
        }
      }
    }
    ?>
  <br>
  <?php if (logged_on()) { ?>
  <center><a id="displayText" href="javascript:toggle();"><img src="img/response.png"></a></center>
  <div id="toggleText" style="display: none">
  <div class="containers">
    <form method="post" action=" ">
      <?php date_default_timezone_set('Asia/Jerusalem'); ?>
      <input type="hidden" name="dateOfPublicity" value="<?php echo date('m/d/Y', time()); ?>">
      <input type="hidden" name="chooseGoo" id="chooseGoo">
      <input type="hidden" name="chooseGos" id="chooseGos">
      <input type="hidden" value="<?php echo $title ?>" name="nameOfStore">
      <input type="text" id="title" name="title" maxlength=15  placeholder="Title" required=""><br /><br>
      דרג את רמת השרות:<br>
      <select id="goservise" name="goservise" class="itemId">
        <option value="☹ ☹ ☹ ☹ ☹">גרוע</option><br>
        <option value="☻☺☺☺☺">לא משהו</option><br>
        <option value="☻☻☺☺☺">סביר</option><br>
        <option value="☻☻☻☺☺">כמעט טוב</option><br>
        <option value="☻☻☻☻☺">טוב מאוד</option><br>
        <option value="☻☻☻☻☻">מציון</option><br>
      </select><br>
      דרג את רמת קלות ההזמנה:
      <br>
      <select id="goorder" name="goorder" class="itemId">
        <option value="☹ ☹ ☹ ☹ ☹">גרוע</option><br>
        <option value="☻☺☺☺☺">לא משהו</option><br>
        <option value="☻☻☺☺☺">סביר</option><br>
        <option value="☻☻☻☺☺">כמעט טוב</option><br>
        <option value="☻☻☻☻☺">טוב מאוד</option><br>
        <option value="☻☻☻☻☻">מציון</option><br>
      </select><br><br>
      <br> <br /><textarea name="contents" placeholder="contents" required=""></textarea><br /><br>
      <input type="submit" value="שלח תגובה" name="submit" />
      <br><br><font color="red" size="2px">זכור תגובה זו תפורסם לאחר בדיקה מעמיקה ולכל היותר לאחר 48 שעות</font>
        </form>

      </div></div><br>
      <script>

          $( "#goservise" ).change(function() {
              $getSelectedServise = $( "#goservise option:selected" ).attr("value");
              $( "#chooseGos" ).attr("value", $getSelectedServise);
          });

          $( "#goorder" ).change(function() {
              $getSelectedServise = $( "#goorder option:selected" ).attr("value");
              $( "#chooseGoo" ).attr("value", $getSelectedServise);
          });

      </script>
        <?PHP
      }
  include ("Includes/footer.php");
?>
<div class="overlay-content popup3">
  <div class="distribution" id="distribution">
    <h1><?php echo ReportItem;?></h1>
    <hr>
    <form action=" " method="post">
      <input type="text" name="userName" value="<?php echo $_SESSION['username']; ?>">
      <input type="text" name="pageName" value="<?php echo $storeTitle; ?>">
      <textarea maxlength="300" name="contents">ברצוני לדווח על: </textarea>
      <hr>
      <button name="resport" id="report">דווח!</button>
            <?php include ("resportPage.php"); ?>
  </form>
  </div>
</div>

<div class="overlay-content popup4">
  <div class="distribution" id="distribution">
    <h1><?php echo regForUpdate;?></h1>
    <hr>
    <form action="" method="post">
      <input type="text" name="userName" value="<?php echo $_SESSION['username']; ?>">
      <input type="text" name="pageName" value="<?php echo $storeTitle; ?>">
      <?php date_default_timezone_set('Asia/Jerusalem'); ?>
      <input type="hidden" name="date" value="<?php echo date('m/d/Y', time());?>">
      <hr>
      <button name="regForUpdate" id="regForUpdate">דווח!</button>
      <?php include("regForUpdate.php"); ?>
  </form>
  </div>
</div>
<script>
  document.title = '<?php echo $title; ?>';
</script>
