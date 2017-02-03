<?php
require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
include("Includes/header.php");

  ?><div class="contain-all-storesResult"> <?
  $sql = "SELECT * FROM stores ORDER BY title DESC";
  $result = $databaseConnection->query($sql);
    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
           ?>
           <div class="blube-effect">
             <p><a href="mystore.php?storename=<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a><br>
               <?php
               if ( $row['responsecounter'] >= BEGINNER_STAR) {
                 ?><span>&#9733;</span><?
               }

               if ( $row['responsecounter'] > FISRT_GRADE) {
                 ?><span>&#9733;</span><?
               }

               if ( $row['responsecounter'] > SECOND_GRADE ){
                 ?><span>&#9733;</span><?
               }

               if ( $row['responsecounter'] > THERED_GRADE ){
                 ?><span>&#9733;</span><?
               }

               if ( $row['responsecounter'] > FOUR_GRADE ){
                 ?><span>&#9733;</span><?
               }

               if ( $row['responsecounter'] > FIVE_GRADE ){
                 ?><span>&#9733;</span><?
               }
               ?>
             </p>
             <div class="inside-logo"><img src="<?php echo $row['logo']; ?>"></div></div>
           <?}
         }

         ?></div><div class="pages"><?

                  for ( $numberBeginnerPage = 1 ; $numberBeginnerPage <= $numOfCounter ; $numberBeginnerPage++){
                    ?><a href="webMapStroes.php?page=<?php echo $numberBeginnerPage; ?>"><?php echo $numberBeginnerPage;?></a><?
                  }

            ?></div><?
include("Includes/footer.php");
?>
<script>
  document.title = '<?php echo mapOfStores; ?>';
</script>
