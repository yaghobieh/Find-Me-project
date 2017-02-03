<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");

    $username = $_SESSION['userid'];
    $title = $_POST['storetitle'];
    $subInfo = $_POST['sub_info'];
    $phoneNumber = $_POST['phoneNumber'];
    $logoPath = $_POST['img'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $webAdress = $_POST['webAdress'];

    if (isset($_POST['addNewStore'])){
      $query = "INSERT INTO stores (title, sub_info, logo, phoneNumber, adress, email, webAdress, manager)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $statement = $databaseConnection->prepare($query);
      $statement->bind_param('ssssssss',$title, $subInfo, $logoPath, $phoneNumber, $location, $email, $webAdress, $username);
      $statement->execute();
      $statement->store_result();

      $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
      if ($creationWasSuccessful){
      echo "<div class='eror'>חנות זהו נוצרה, תודה רבה</div>";
      myRefresh("./index.php");
    }
    else{
      echo "<div class='eror'>אנא מלא/י את הפרטים אודות חנותך נכון</div>";
    }
  }
?>
<!DOCTYPE html>
<br><br>
<?php
 if (logged_on())
      {
?>
  <div class="regbuss">
    <!---all css atribut from Connection.css--->
    <form name="login-form" action=" " method="post">
      <h1>סגנן בית עסק חדש</h1>
      <input placeholder="שם החנות" type="text" class="input username" name="storetitle"
      autofocus="" required="" autocomplete="off"/><br><br>
      <input placeholder="תמונת לוגו" type="text" name="img" class="input username" autocomplete="off"/><br><br>
      <input placeholder="מידע מקדים" type="text" name="sub_info" class="input username" autocomplete="off"/>
      <!---all css atribut from business.css---><br><br>
      <input placeholder="מספר טלפון" type="text" name="phoneNumber" class="input username" autocomplete="off"/><br><br>
      <input placeholder="כתובתת מיקום" type="text" name="location" class="input username" autocomplete="off"/><br><br>
      <input placeholder="אתר אינטרנט" type="text" name="webAdress" class="input username" autocomplete="off"/><br><br>
      <input placeholder="מייל תקין" type="email" name="email" class="input username" autocomplete="off"/><br><br>
      <button type="submit" name="addNewStore" class="lined" value="LogIn"/>צור</button>
    </form>
  </div>

  <?php }else
     echo "<div class='eror'>עלייך להיות רשום למערכת בכדי שתוכל ליצור חנות חדשה</div>";
   ?>
<?php include ("Includes/footer.php"); ?>
