<?php
            require_once ("Includes/simplecms-config.php");
        require_once  ("Includes/connectDB.php");
        include("Includes/header.php");
        
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>

	</head>
	<body>
       <!----Pics Div center CSS:Between---->
        <a href="#top"></a><br>
        <div class="takeSideLeft">
            <div class="ebBody">
            <p>סמארטפונים וציוד</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="551.jpg">
            </div>
            <div class="divTakePic">
            <p>טלוויזיות</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="536.jpg">
            </div>
            <div class="divTakePic">
            <p>מחשבים ותוכנה</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="583.jpg">
            </div>
              <div class="divTakePic">
            <p>מצלמות וגופרו</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="577.jpg">
            </div>
            <br>

            <div class="divTakePic">
            <p>לאם ולתינוק</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="611.jpg">
            </div>
            <div class="divTakePic">
            <p>חיות וציוד</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="1250.jpg">
            </div>
             <div class="divTakePicBig">
            <p>נופש ומלונות</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="hotels.jpg">
            </div>
            <br>
            <div class="divTakePic">
            <p>לבית ולגינה</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="553.jpg">
            </div>
            <div class="divTakePic">
            <p>מכונות קפה</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="685.jpg">
            </div>
             <div class="divTakePic">
            <p>מקררים</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="628.jpg">
            </div>
             <div class="divTakePic">
            <p>מכונות כביסה</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="852.jpg">
            </div>
            <br>

            <div class="divTakePic">
            <p>לאם ולתינוק</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="611.jpg">
            </div>
            <div class="divTakePic">
            <p>חיות וציוד</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="1250.jpg">
            </div>
             <div class="divTakePicBig">
            <p>נופש ומלונות</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="hotels.jpg">
            </div>
            <br>
            <div class="divTakePic">
            <p>לבית ולגינה</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="553.jpg">
            </div>
            <div class="divTakePic">
            <p>מכונות קפה</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="685.jpg">
            </div>
             <div class="divTakePic">
            <p>מקררים</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="628.jpg">
            </div>
             <div class="divTakePic">
            <p>מכונות כביסה</p>
            <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
                <img src="852.jpg">
            </div>
        </div>

        <div class="takeSideRight">

          <div class="SpecFont"><strong>נושאים חמים</strong></div>
          <div class="divInfo">
            <div class="littleInfoInCat">
              <?php
              $statement = $databaseConnection->prepare("SELECT id, menulabel, idBlock FROM pages");
              $statement->execute();
                if($statement->error)
                {
                 die("Database query failed: " . $statement->error);
                 }
                    $statement->bind_result($id, $menulabel, $idBlock);
                 while($statement->fetch())
                 {
                    if ( $idBlock == 1 ) {
                   echo "<< ";
                   echo "$menulabel ";
                }
              }
               ?>
            </div>
            <div class="littleFont"><a href="#">טלויזיות, מצלמות, טלפונים סלולריים,<br>
              מזגנים, מקררים, אוזניות, מדיחי כלים,<br>
              מכונות כביסה, תנורי אפייה, שואבי אבק,<br>
              סטרימרים עוד...
            </a></div>
         </div><br><br>
         <div class="divInfo">
           <div class="littleInfoInCat">
             <?php
             $statement = $databaseConnection->prepare("SELECT id, menulabel, idBlock FROM pages");
             $statement->execute();
               if($statement->error)
               {
                die("Database query failed: " . $statement->error);
                }
                   $statement->bind_result($id, $menulabel, $idBlock);
                while($statement->fetch())
                {
                   if ( $idBlock == 2 ) {
                  echo "<< ";
                  echo "$menulabel ";
               }
             }
              ?>
           </div>
           <div class="littleFont"><a href="#">טלויזיות, מצלמות, טלפונים סלולריים,<br>
             מזגנים, מקררים, אוזניות, מדיחי כלים,<br>
             מכונות כביסה, תנורי אפייה, שואבי אבק,<br>
             סטרימרים עוד...
           </a></div>
        </div><br><br>

       <div class="divInfo">
         <div class="littleInfoInCat">
           <?php
           $statement = $databaseConnection->prepare("SELECT id, menulabel, idBlock FROM pages");
           $statement->execute();
             if($statement->error)
             {
              die("Database query failed: " . $statement->error);
              }
                 $statement->bind_result($id, $menulabel, $idBlock);
              while($statement->fetch())
              {
                 if ( $idBlock == 3 ) {
                echo "<< ";
                echo "$menulabel ";
             }
           }
            ?>
         </div>
         <div class="littleFont"><a href="#">טלויזיות, מצלמות, טלפונים סלולריים,<br>
           מזגנים, מקררים, אוזניות, מדיחי כלים,<br>
           מכונות כביסה, תנורי אפייה, שואבי אבק,<br>
           סטרימרים עוד...
         </a></div>
      </div>
        <br><br>
        <div class="divInfo">
          <div class="littleInfoInCat">
            <?php
            $statement = $databaseConnection->prepare("SELECT id, menulabel, idBlock FROM pages");
            $statement->execute();
              if($statement->error)
              {
               die("Database query failed: " . $statement->error);
               }
                  $statement->bind_result($id, $menulabel, $idBlock);
               while($statement->fetch())
               {
                  if ( $idBlock == 4 ) {
                 echo "<< ";
                 echo "$menulabel ";
              }
            }
             ?>
          </div>
          <div class="littleFont"><a href="#">טלויזיות, מצלמות, טלפונים סלולריים,<br>
            מזגנים, מקררים, אוזניות, מדיחי כלים,<br>
            מכונות כביסה, תנורי אפייה, שואבי אבק,<br>
            סטרימרים עוד...
          </a></div>
       </div>

      <br><br>
      <div class="divTakePic">
     <p>מכונות כביסה</p>
     <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
         <img src="852.jpg">
     </div>
     <br>
     <div class="divTakePic">
     <p>מקררים</p>
     <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
        <img src="628.jpg">
     </div>
     <br>
     <div class="divTakePic">
     <p>מקררים</p>
     <li>Messgae <?php echo "{$_SESSION['getMesssage']}";?> | Views <?php echo "{$_SESSION['getViews']}";?></li>
        <img src="628.jpg">
     </div>
   </div>


 </div><br>
        <br><br><br>

        <!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>
<?php
    include ("Includes/footer.php");
 ?>
