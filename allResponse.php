<link rel="stylesheet" type="text/css" href="/findme/css/control_c.css" />
<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
/********************************************/
if (is_admin()){
  $sql = "SELECT * FROM response_store";
  $result = $databaseConnection->query($sql);
    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
           ?>
            <div class="responseBy">
              <div class="responseByInsideCenter">
                תגובה זו נכתבה ע"י": <a href='profile.php?username={$row['username']}' target='_blank'><?php echo $row['username']; ?></a><br>
                בשביל חנות/ בית עסק: <?php echo $row['storename']; ?><br><br>

              </div>
              <div class="responseByInsideFoot"><br><br>
                  <form action=" " method="POST">
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="idForErase">
                    <input type="submit" name="submit" value="X" />
                  </form>
                  <form action=" " method="POST" class="responseByInsideCenter">
                    <input type="text" placeholder="<?php echo $row["title"]; ?>" name="newTitle" id="newTitle">
                    <textarea name="newText" id="newText"><?php echo $row['contents']; ?></textarea>
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="idChoose">
                    <input type="hidden" value="" name="letItBe">
                    <input type="submit" name="Edit" value="Edit" />
                  </form>
              </div>
            </div>
           <?
           include("editResponse.php");
           include ("eraseResponse.php");
         }
      }
    }
?>
