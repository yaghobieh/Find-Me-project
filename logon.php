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
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT id, username FROM users WHERE username = ? AND password = SHA(?) LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $username, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($_SESSION['userid'], $_SESSION['username']);
            $statement->fetch();
             echo "<div class='eror'>תודה שהתחברת, מייד תועבר<br></div>";
            ?><script>parent.history.back();</script><?
            die();
        }
        else
        {
           echo "<div class='eror'>התרחשה שגיאה בלתי צפויה!<br>שם המתשמש או הסיסמא לא נוכנים</div>";
        }
    }

?>

</div><br><br>

<form name="login-form" class="login-form" action=" " method="post">
  <h1>התחברות למערכת:</h1>
  <input placeholder="Enter your username" type="text" class="input username" name="username" autofocus="" autocomplete="off"/>
  <input placeholder="Password" type="password" name="password" class="input password" autocomplete="off"/>
  <button type="submit" name="submit" value="logIn"/>התחבר/י כעת</button>
  <p><a href="forgotMyPassword.php">שכחתי את הסיסמא שלי</a></p>
    <!------<h3>Or</h3>
  <a href="fbconfig.php"><img src="img/Facebook-icon.png"></a>
  <img src="img/Twitter-icon.png">&nbsp;&nbsp;
  &nbsp;&nbsp;<img src="img/google-plus-icon.png">
  -------------->
</form>

<?php
    include ("Includes/footer.php");
 ?>
 <script>
   document.title = '<?php echo LOGON; ?>';
 </script>
