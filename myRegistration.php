<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");

$username = $_SESSION['username'];
$query = "SELECT DISTINCT *  FROM update_reg_users WHERE username = '$username' ";

  ?><div class="rss-contain"> <?
  $result = $databaseConnection->query($query);
    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
            ?><li><?php echo $row['name_item']; ?>
              <p><?php echo $row['time_register']; ?></p>
              </li> <?
         }
       }
  ?></div><?
 include("Includes/footer.php");
?>
<script>
  document.title = '<?php echo Registration.' ' .$username ; ?>';
</script>
