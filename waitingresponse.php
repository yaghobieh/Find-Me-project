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
          if ( $row["publicity"] == "false") {
           ?>
            <div class="responseBy">
              <div class="responseByInside">
                <p>Grades</p>
                <b>Grade of Servise</b><br> <img src='{$row['gradeOfServise']}'><br>
                <b>Grade of Order</b><br> <img src='{$row['gradeOfEasyOrder']}'>
              </div>
              <div class="responseByInsideCenter">
                Writer: <a href='profile.php?username={$row['username']}' target='_blank'><?php echo $row['username']; ?></a> |
                For store: <?php echo $row['storename']; ?><br><br>
                <b><?php echo $row["title"]; ?></b><br>
                <pre><?php echo $row['contents']; ?></pre>
              </div>
              <div class="responseByInsideFoot"><br><br>
                  <form action=" " method="POST">
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="idForErase">
                    <input type="submit" name="submit" value="Erase" />
                  </form>
                  <form action=" " method="POST">
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="idChoose">
                    <input type="hidden" value="true" name="letItBe">
                    <input type="submit" name="submit" value="אשר" />
                  </form>
              </div>
            </div>
           <?
           include("confirmResponseStore.php");
           include ("eraseResponse.php");
         }
      }
    }
}
?>
