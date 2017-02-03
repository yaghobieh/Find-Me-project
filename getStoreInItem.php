<?php

  $store_name = $row["store_name"];
  $price_store = $row["price"];
  $availableS = $row['available'];

  $sql = "SELECT * FROM stores WHERE title = '$store_name' ";
  $results = $databaseConnection->query($sql);
      if ($results->num_rows > 0) {
          // output data of each row
          while($rowGetInfo = $results->fetch_assoc()) {
            ?>
                <div class="store_inline" id="store_inline">
                  <div class="store_inline_sidePic">
                    <img src="<?php echo $rowGetInfo['logo']; ?>">
                  </div>
                  <div class="store_inline_other">
                    <p><a href="mystore.php?storename=<?php echo $rowGetInfo['title']; ?>"><?php echo $rowGetInfo['title']; ?></a></p><br>
                    <?
                    if ( $rowGetInfo['responsecounter'] >= 0) {
                      ?><span>&#9733;</span><?
                    }
                    if ( $rowGetInfo['responsecounter'] > 3) {
                      ?><span>&#9733;</span><?
                    }
                    if ( $rowGetInfo['responsecounter'] > 5 ){
                      ?><span>&#9733;</span><?
                    }
                    if ( $rowGetInfo['responsecounter'] > 15 ){
                      ?><span>&#9733;</span>
                      <script>
                        $("#store_inline").css('background-color', '#CF061E');
                      </script>
                      <?
                    }
                    if ( $rowGetInfo['responsecounter'] > 30 ){
                      ?><span>&#9733;</span>
                      <script>
                        $("#store_inline").css('background-color', '#CF061E');
                      </script>
                      <?
                    }
                    if ( $rowGetInfo['responsecounter'] > 40 ){
                      ?><span>&#9733;</span>
                      <script>
                        $("#store_inline").css('background-color', '#CF061E');
                      </script>
                      <?
                    }
                    ?><br>
                    <?php echo $rowGetInfo['sub_info']; ?><br>
                    <?php echo $rowGetInfo['adress']; ?>
                    <br><u>לחנות זו:</u> <?php echo $rowGetInfo['responsecounter']; ?> תגובות

                  </div>
                    <div class="side-block">
                    <?php
                      if ($availableS ==  yes){
                        echo $price_store;
                        ?><br><?
                        echo '<img src="img/haveInMlai.png">';
                      }else{
                        ?> <?php echo $price_store; ?><br>
                          <img src="img/onInMlai.png">
                          <?
                      }
                      ?>
                      <br><u>ימי הספקה:</u> <?php echo $row['deliveryDays']; ?><br>
                      <u>מחיר משלוח:</u> <?php echo $row['deliveryPrice']; ?>
                  </div>
                </div>
            <?
          }
        }
?>
