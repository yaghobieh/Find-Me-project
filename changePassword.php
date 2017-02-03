<?php
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php");
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");

    $InsertThisEmail = $_GET['mail'];
    if (isset($_POST['submit']))
    {
        $newPasswordMd5 = $_POST['newPassword'];

        $query = "UPDATE users SET password = SHA(?) WHERE email = ?";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $newPasswordMd5, $InsertThisEmail);
        $statement->execute();
        $statement->store_result();

        $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful){
          $to = $email;
          $subject = 'אישור שינוי סיסמא- Find Me Group©';
          $mesage = 'סיסמתך שונתה לאחרונה';

          $headers = 'סיסמתך שונתה בצהלחה';

          mail($to, $subject, $mesage, $headers);
            echo "<div class='eror'>פעולה זו בוצעה בהצלחה</div>";
        }
        else
        {
           echo "<div class='eror'>אחד הפרטים או יותר לא נכונים</div>";
        }
    }

?>

</div><br><br>

<form name="login-form" class="login-form" action=" " method="post">
  <h1>Enter your new Password: </h1>

  <input placeholder="Enter your new password" type="password" class="input username" name="newPassword" autofocus="" autocomplete="off" required="" id="newPassword"/>

  <button type="submit" name="submit" value="chnageMyPass" id="checkThisEmail"/>Change my Password</button>
</form>

<?php include ("Includes/footer.php");?>

 <script>
   document.title = '<?php echo CHANGE_ֹPASSSWORD; ?>';
 </script>
