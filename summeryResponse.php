<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");

if (logged_on()) {
?><div class="all-response-toShow"><?

  if (isset($_GET['username'])){

    $showResponseOfThisUserName = $_GET['username'];

    $sql = "SELECT * FROM response_store WHERE username = '$showResponseOfThisUserName' ";
    $result = $databaseConnection->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            if ( $row["publicity"] == "true") {
              ?><div class="all-inside-info">
                    <div class="all-inside-divs-border">
                      אהבו: <?php echo $row['likeCounter']; ?> | לא אהבו: <?php echo $row['unlikeCounter']; ?><br>
                      תאריך פרסום :<?php echo $row['dateOfPublicity']; ?>
                    </div>
                    <div class="all-inside-divs">
                      <span><?php echo $row['title']; ?></span>
                      <?php echo $row['contents']; ?>
                    </div>
                </div>
              <?
            }
          }
        }
  } else{
      echo "<div class='eror'>אין עמוד כזה או שעמוד זה הוסר</div>";
        ?><script>parent.history.back();</script><?
  }

  ?></div><?
}else{
  echo "<div class='eror'>אופס עלייך להיות מחובר</div>";
    ?><script>parent.history.back();</script><?
}
?>
<script>
  document.title = '<?php echo SummeryReportes .' ' .$showResponseOfThisUserName; ?>';
</script>
