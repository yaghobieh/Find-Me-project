<link rel="stylesheet" type="text/css" href="/findme/css/control_c.css" />
<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
/********************************************/
if (is_admin()){
  $sql = "SELECT * FROM response";
  $result = $databaseConnection->query($sql);
    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
          if ( $row["publicity"] == "false") {
           ?>
            <div class="responseBy">
              <div class="responseByInsideCenter">
                Writer: <a href='profile.php?username={$row['username']}' target='_blank'><?php echo $row['userWrite']; ?></a> |
                For Item: <?php echo $row['itemID']; ?><br><br>
                <b><?php echo $row["title"]; ?></b><br>
                <pre><?php echo $row['contents']; ?></pre>
              </div>
              <div class="responseByInsideFoot">
                  <form action=" " method="POST">
                    <input type="hidden" value="<?php echo $row['response_id']; ?>" name="idForEraseItem">
                    <input type="submit" name="submit" value="Erase" />
                  </form>
                  <form action=" " method="POST">
                    <input type="hidden" value="<?php echo $row['response_id']; ?>" name="idChoosedItem">
                    <input type="submit" name="submit" value="אשר" />
                  </form>
              </div>
            </div>
           <?
           include("eraseResponseitem.php");
           include("confirmResponseItems.php");
         }
      }
    }
}
?>
