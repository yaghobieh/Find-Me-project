<?php
  require_once ("Includes/simplecms-config.php");
  require_once  ("Includes/connectDB.php");
  include("Includes/header.php");
  /*************************************/

  $storeID = $_GET['storeid'];
    $query = 'SELECT title, sub_info, manager, logo, phoneNumber, adress, email, webAdress
              FROM stores WHERE id = ? LIMIT 1';

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('s', $storeID);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    if ($statement->num_rows == 1)
    {
        $statement->bind_result($title, $sub_info, $manager, $logo, $phoneNumber, $adress, $email, $webAdress);
        $statement->fetch();
          include ("Includes/editStore.php");
          include("Includes\updateInfo.php");
          if (ifOwnerThisStore($title) || is_admin()){
        ?>
          <br><br>
          <div class="storeTopTitle">
            <h1>מידע מקדים אודות העמוד שלך </h1><br>
            <form action=" " method="POST">
              <input type="hidden" value="<?php echo $title; ?>" name="titleStore" >
              <input type="text" value="<?php echo $title; ?>" name="newTitleStore">
              <input type="text" value="<?php echo $logo; ?>" name="logo">
              <input type="text" value="<?php echo $sub_info; ?>" name="subInfo">
              <input type="phone" value="<?php echo $phoneNumber; ?>" name="phoneNumber">
              <input type="text" value="<?php echo $adress; ?>" name="adress">
              <input type="text" value="<?php echo $webAdress; ?>" name="webAdress">
              <input type="text" value="<?php echo $email; ?>" name="email">
              <br><br>
              <input type="submit" name="update" value="update">
            </form>
            <hr>
            <form action="" method="POST" enctype="multipart/form-data">
              <input type="hidden" value="<?php echo $title; ?>" name="titleStore" >
              <input type="file" name="image" />
              <input type="submit" name="upload" value="העלאת תמונה חדשה"/>
             <?php include("uploadStore.php"); ?>
           </form>
          </div>
          </div>
          <center><br><hr width="70%"><br></center>
          <div class="storeTopTitle">
            <h1>בחר מוצר חדש: </h1><br>
            <div class="optionsIn" id="optionsIn">
              <h4>בחר מוצר להתווסף אליו: </h4>
              </div>
            <div class="optionsIn" id="optionsIn">
              <?php makeSelectionPlatform(); ?>
            </div>
            <?php include ("Includes/updateItems.php"); ?>
            <form action=" " method="post">
              <div class="optionsIn" id="optionsInNew">
                <input type="hidden" value="<?php echo $title; ?>" name="titleStoreL" >
              </div>
            </form>
          </div>
              <script>

                  $( "#itemId" ).change(function() {
                    var $div = $('<div>');
                    var $button = $('<input type="submit" name="submit" value="update">');
                    var $getSelectionValue = $( "#itemId option:selected" ).attr("value");
                    var $getSelectionText = $( "#itemId option:selected" ).text();
                    var $divName = $( "<input type='text' name='getItemName' id='getItemName'>" );
                    var $divID = $( "<input type='hidden' name='getItemID' id='getItemID'>" );

                    $divID.attr("value", $getSelectionValue);
                    $divName.attr("value", $getSelectionText);
                    $divID.text($getSelectionValue);
                    $divName.text($getSelectionValue);

                    $div.append( $divID );
                    $div.append( $divName );
                    $div.append( "<input type='text' id='newPrice' name='newPrice'><br><br>" );
                    $div.append($button);

                    $('#optionsInNew').append($div);
                  });
            </script>
            <center><br><hr width="70%"><br></center>
            <div class="storeTopTitle">
              <h1>עריכת רשומים: </h1><br>
              <?php include("allBinLoadItem.php");
                        include("changePriceOfBinItem.php");
                        include("deleteMeFromThisItem.php");?>

              <div class="optionsIn" id="getItemsIn"></div>
            </div>
        <?
      }else{
          echo "<div class='eror'>אינך מנהל את החנות הזו</div>";
      }
    }
    else
    {
        echo "<div class='eror'>התרחשה שגיאה בלתי צפוייה</div>";
    }

  include ("Includes/footer.php");
 ?>

 <script>
   document.title = '<?php echo $title .' ' .EditStore; ?>';
 </script>
