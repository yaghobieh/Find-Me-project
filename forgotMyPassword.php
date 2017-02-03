<?php
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php");
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");

    if ($_SESSION['username'] <> NULL){
         echo "<div class='eror'>הינך מחובר/ת למערכת<br>תכף תועבר לעמוד הראשי</div>";
          ?><script>parent.history.back();</script><?
         die();
    }

    if (isset($_POST['submit']))
    {
        $checkThisEmailSent = $_POST['email'];

        $query = "SELECT * FROM users WHERE email = ?";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('s', $checkThisEmailSent);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == ONE)
        {
            ?>
              <script>alert('הזיהוי הושלם');  </script>
            <?
            myRefresh("./changePassword.php?mail=$checkThisEmailSent");
        }
        else
        {
           echo "<div class='eror'>אין מייל כזה או ההפרטים לא נכונים</div>";
        }
    }

?>

</div><br><br>

<form name="login-form" class="login-form" action=" " method="post">
  <h1>Enter your Email: </h1>
  <input placeholder="Enter your @email" type="email" class="input username" name="email" autofocus="" autocomplete="off" required="" id="email"/>

  <input placeholder="Enter your new password***" type="hidden" class="input username" name="newPassword" autofocus="" autocomplete="off" required="" id="newPassword"/>

  <button type="submit" name="submit" value="checkThisEmail" id="checkThisEmail"/>Check Mail</button>
</form>

<?php
    include ("Includes/footer.php");
 ?>
