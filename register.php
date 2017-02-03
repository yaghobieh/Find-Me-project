<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");
    $i=1;
    if ($_SESSION['username'] <> NULL)
    {
         echo "<div class='eror'>הינך מחובר/ת למערכת<br>תכף תועבר לעמוד הראשי</div>";
         myRefresh("index.php");
         die();
    }
    $password = $_POST['password'];
    $passwordS = $_POST['passwordS'];
    if (isset($_POST['submit'])){
        $uname = $_POST ['username'];
        $filtered_string = filter_var ($uname, FILTER_SANITIZE_STRING);
        $username = $filtered_string;
        if ( $password == $passwordS && strlen($password) >= 6)
        {
          $password = $_POST['password'];
        }
        else {
          echo "<div class='eror'>התרחשה השגיאה הבאה: סיסמאות לא תואמות או אורכן קטן משש ספרות</div>";
          die();
        }
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $celnum = $_POST['cellnum'];
        $sex = $_POST['sex'];
        $city = $_POST['city'];
        $sql = "SELECT * FROM users where username = '$username'";
        $result = $databaseConnection->query($sql);
        $numRows =  $result->num_rows;
        if ($numRows <> 0)
        {
            echo "<div class='eror'>התרחשה שגיאה! משתמש זה או מייל זה כבר קיים במערכת</div><br>";
            myRefresh("register.php");
            die();
        }else{
        $query = "INSERT INTO users (username, password, fname, lname, email, celnum, sex, city) VALUES (?, SHA(?), ?, ?, ?, ?, ?, ?)";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ssssssss', $username, $password, $fname, $lname, $email, $celnum, $sex, $city);
        $statement->execute();
        $statement->store_result();

        $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful)
        {
            $userId = $statement->insert_id;

            $addToUserRoleQuery = "INSERT INTO users_in_roles (user_id, role_id) VALUES (?, ?)";
            $addUserToUserRoleStatement = $databaseConnection->prepare($addToUserRoleQuery);

            // TODO: Extract magic number for the 'user' role ID.
            $userRoleId = 2;
            $addUserToUserRoleStatement->bind_param('dd', $userId, $userRoleId);
            $addUserToUserRoleStatement->execute();
            $addUserToUserRoleStatement->close();
            //$to = $email;
            //SendRegMail ($to);
            $filename = "documents/usernames.txt";
            $handle = fopen($filename, "a");
            fwrite($handle, $username );
            fwrite($handle, ' | ' );
            fclose($handle);
            $_SESSION['userid'] = $userId;
            $_SESSION['username'] = $username;

            $to = $email;
            $subject = 'אישור הרשמה- Find Me Group©';
            $mesage = 'נרשמת בהצלחה, בירכותינו!';

            $headers = 'ההרשמה בוצעה בהצלחה, ודה על שנרשמת לFind me. נשמח לעזור לך גם בעתיד. מקווים שתהנה אצלנו';

            mail($to, $subject, $mesage, $headers);

            myRefresh("javascript:history.back()");
        }
        else
        {
            echo "<div class='eror'>התרחשה שגיאה! משתמש זה או מייל זה כבר קיים במערכת</div><br>";
        }
  }  }
?>
<!DOCTYPE html>
<br><br>
 <div class="containers">
    <form action=" " method="post">
    <div class="row">
      <h4>הרשמה</h4>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="שם משתמש" id="username" name="username" required=""/>
        <div class="input-icon"><i class="fa fa-user"><img src="img/userreg.png"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="שם פרטי" id="fname" name="fname" required=""/>
        <div class="input-icon"><i class="fa fa-envelope"><img src="img/namereg.png"></i></div>
      </div>
        <div class="input-group input-group-icon">
        <input type="text" placeholder="שם משפחה" id="lname" name="lname" required=""/>
        <div class="input-icon"><i class="fa fa-envelope"><img src="img/namereg.png"></i></div>
      </div>
        <div class="input-group input-group-icon">
        <input type="text" placeholder="כתובת מייל" id="email" name="email" required=""/>
        <div class="input-icon"><i class="fa fa-envelope"><img src="img/atreg.png"></i></div>
      </div>
        <div class="input-group input-group-icon">
        <input type="text" placeholder="מספר טלפון" id="cellnum" name="cellnum" required=""/>
        <div class="input-icon"><i class="fa fa-envelope"><img src="img/phnumreg.png"></i></div>
      </div>
        <div class="input-group input-group-icon">
        <input type="password" placeholder="סיסמא" id="password" name="password" required=""/>
        <div class="input-icon"><i class="fa fa-envelope"><img src="img/passreg.png"></i></div>
      </div>
      <div class="input-group input-group-icon">
      <input type="password" placeholder="חזור על הסיסמא" id="passwordS" name="passwordS" required=""/>
      <div class="input-icon"><i class="fa fa-envelope"><img src="img/passreg.png"></i></div>
    </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>תאריך לידה</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" placeholder="DD"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="MM"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="AAAA"/>
          </div>
        </div>
      </div>
      <div class="col-half">
        <h4>זכר/ נקבה</h4>
        <div class="input-group" name="city" required="">
          <select name="sex">
            <option selected="">בחירה</option>
            <option value="Male">זכר</option>
            <option value="Fmaile">נקבה</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>חשבון פייסבוק</h4>
        <div class="input-group input-group-icon">
          <input type="text" placeholder="FaceBook"/>
          <div class="input-icon"><i class="fa fa-credit-card"><img src="img/facebookreg.png"</i></div>
        </div>
      </div>
      <div class="col-half">
        <h4>עיר</h4>
        <div class="input-group" name="city">
          <select name="city">
            <option selected="">Location</option>
            <option value="Center">גוש דן והמרכז</option>
            <option value="South">דרום והשפלה</option>
            <option value="North">צפון הארץ</option>

          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <h4>אשר קריאת תקנון</h4>
      <div class="input-group">
        <input type="checkbox" id="terms" required=""/>
        <label for="terms" style="font-size: 80%;">קראתי את <a href="termsOfUse.php" target="_blank">תקנון המערכת</a> ואני מאשר אותו</label></br>
        <input name="submit" id="submit" tabindex="5" value="הרשמה" type="submit"/>
        <input name="submit" id="submit" tabindex="6" value="נקה טופס" type="reset">
      </div>
    </div>
  </form>
</div>

<script>
  document.title = '<?php echo REDISTER; ?>';
</script>
