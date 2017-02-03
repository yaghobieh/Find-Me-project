<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");
include("Includes/responseCenterItem.php");

if (isset($_GET['itemid'])){

  $itemid = $_GET['itemid'];

  $sql = "SELECT * FROM response WHERE itemID = $itemid ORDER BY response_id DESC ";
  $result = $databaseConnection->query($sql);
    if ($result->num_rows > ZERO) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
          if ($row['publicity'] == "true" ){
            $user = $row['userWrite'];
            ?>
            <div class="responseBy">
              <div class="responseByInside">
                <div class="profileInfo">
                  <?php //Include("getUserPic.php");
                    //$getPictureReturn = getUserPicture($row['username']);
                    $user = $row['userWrite'];
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
                  שם: <a href='profile.php?username=<?php echo $row['userWrite']; ?>' target='_blank'><?php echo $row['userWrite']; ?></a><br><br>
                   <a href="summeryResponse.php?username=<?php echo $row['userWrite']; ?>">צפה בתגובות משתמש זה</a>
                </div>
              </div>
                <div><br>


                </div>
              </div>
              <div class="responseByInsideCenter">
                <p>משתמשים מתארים: </p><br>
                <b><?php echo $row["title"]; ?></b><br><br>
                  <p id="alignIn-responseByInsideCenter"><?php echo $row['contents']; ?></p>
              </div>
            </div>
          </div>
            <?
          }
        }
      }
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
<?
}
?>
