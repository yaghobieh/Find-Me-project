<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");

?>
<!DOCTYPE html>
<br><br>
  <div class="buss">
    <center><h1>ברוכה הבאה לעמוד העסק החדש</h1><br>
    <img src="img/store-icon.png"></center>
    <center><button class='lined thin' onClick="parent.location='termsOfUse.php'">קרא/י תקנון</button>
    <button class='lined thin' onClick="parent.location='regnewbuss.php'">צור/י חנות</button></center>
    <br><br><center><link>*אנא קראת את התקנון לפני שימוש</link></center>
  </div>

<?php include ("Includes/footer.php"); ?>
