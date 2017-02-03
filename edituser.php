<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
include("Includes/header.php");

$id = null;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT username, password, fname, lname,
                    email, celnum, sex, city, userPic FROM users WHERE id = ?";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $id);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    $pageExists = $statement->num_rows == 1;
    if ($pageExists)
    {
        $statement->bind_result($username, $password, $fname, $lname, $email,
                                $celnum, $sex, $city, $userPic);
        $statement->fetch();
    }
    else
    {
        header("Location: index.php");
    }
}
else if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $celnum = $_POST['celnum'];
    $sex = $_POST['sex'];
    $city = $_POST['city'];
    $userPic = $_POST['userPic'];
    $query = "UPDATE users SET username = ?, password = ?, fname= ?, lname = ?, email= ?,
                     celnum= ?, sex= ?, city = ?, userPic = ?  WHERE Id = ?";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('sssssssssd', $username, $password, $fname, $lname, $email, $celnum, $sex, $city, $userPic, $id);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful)
    {
        echo "<div class='eror'>עמוד זה נערך כראוי, תודה רבה!</div>";
        myRefresh('index.php');
    }
    else
    {
        echo "<div class='eror'>אופס שגיאה, נסה שנית</div>";
        myRefresh('selectuser.php');
    }
}
else
{
    myRefresh('index.php');
}
?><br>
<?php if (is_admin()){ ?>
<div class="containers">
    <h1>Edit User</h1>
    <form action="edituser.php" method="post">

                <ol>
                    <li>
		      	<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                        <p>ערוך שם משתמש</p>
                        <input type="text" name="username" value="<?php echo $username; ?>" id="username" />
                    </li>
                    <div class="col-half">
                      <h4>שם פרטי</h4>
                        <input type="text" name="fname" value="<?php echo $fname; ?>" id="fname" />
                    </div>
                    <div class="col-half">
                      <h4>שם משפחה:</h4>
                      <input type="text" name="lname" value="<?php echo $lname; ?>" id="lname" />
                    </div>
                    <div class="col-half">
                      <h4>תמונת פנים:</h4>
                      <input type="text" name="userPic" value="<?php echo $userPic; ?>" id="userPic" />
                    </div>
                    <div class="col-half">
                      <h4>סיסמא:</h4>
                      <div class="input-group" name="password">
                        <input type="password" name="password" value="<?php echo $password; ?>" id="password" />
                      </div>
                    </div>
                    <div class="col-half">
                      <h4>אימייל:</h4>
                      <input type="text" name="email" value="<?php echo $email; ?>" id="email" />
                    </div>
                    <div class="col-half">
                      <h4>מספר טלפון:</h4>
                      <div class="input-group" name="password">
                        <input type="text" name="celnum" value="<?php echo $celnum; ?>" id="celnum" />
                      </div>
                    </div>
                    <div class="col-half">
                      <h4>מין:</h4>
                      <div class="input-group" name="city" required="">
                        <select name="sex">
                          <option selected="">בחירה</option>
                          <option value="Male">זכר</option>
                          <option value="Fmaile">נקבה</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-half">
                      <h4>אזור מגורים:</h4>
                      <div class="input-group" name="city">
                        <div class="input-group" name="city">
                          <select name="city">
                            <option selected="">בחירה</option>
                            <option value="Center">גוש דן והמרכז</option>
                            <option value="South">דרום והשפלה</option>
                            <option value="North">צפון הארץ</option>

                          </select>
                        </div>
                      </div>
                    </div>
                </ol>
                <input type="submit" name="submit" value="שלח עריכה זו" />
                <p>
                    <a href="index.php">חזור לעמוד ראשי</a>
                </p>

    </form>
</div>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php }else{
  ?><div class="eror">אין לך מספיק הרשאות בכדי לגשת לעמוד זה</div><?
}
 include ("Includes/footer.php"); ?>

 <script>
   document.title = '<?php echo EDIT_USER; ?>';
 </script>
