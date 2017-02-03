<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");
?>

<br><br>
    <div class="title_tb">
<?php
       //$userid = $_GET['userid'];
        $username = $_GET['username'];
        $query = 'SELECT id, username, fname, lname, sex, city, email, userPic FROM users WHERE username = ? LIMIT 1';
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('s',  $username);
        $statement->execute();
        $statement->store_result();
        if ($statement->error)
        {
            die('Database query failed: ' . $statement->error);
        }

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($id, $username, $fname, $lname, $sex, $city, $email, $userPic);
            $statement->fetch();
        }
        else
        {
            echo 'אין עמוד כזה או שעמוד זה אינו זמין';
        }
    ?>

      <?php if (logged_on()) {
          ?><div class="topInfo">
                <a href="summeryResponse.php?username=<?php echo $username; ?>">צפה בתגובות משתמש זה</a> |
                <? if (ifProfileBind($username) == true ) {
                  ?> <a href="myRegistration.php">צפה בהרשמות שלך</a><?
                }
                ?>
            </div>
          <?
        }
        ?>
            		<div id="container">
			<div id="avatar"></div>
      <script>
        $('#avatar').css('background-image','url(<?php echo $userPic; ?>)');
      </script>
			<div id="av-bg"></div>
			<div id="cover-pic"></div>

			<div id="yo">
                <? if (ifProfileBind($username) == false ) { ?>
                  <h2><?php echo "$username";   if (is_store_manage() ) {?>
                    (<?php echo getStoreName($id); ?>) <br>
                  <?  } ?></h2><br><hr width="300px">
                <p class="myP"><u>שם מלא:</u> <?php echo "$fname $lname"; ?></p><br>
				        <p class="myP"><u>מין:</u> <?php echo "$sex"; ?></p><br>
                <p class="myP"><u>מייל:</u> <?php echo "$email"; ?> </p><br>
                <p class="myP"><u>אזור מגורים:</u> <?php echo "$city"; ?> </p><br>
                <?
                }else{ ?>
                  <p>תמונות פרופיל: </p><br>
                  <form action="" method="POST" enctype="multipart/form-data" class="upload">
                    <input type="hidden" value="<?php echo $id; ?>" name="userid" >
                    <input type="file" name="image" />
                    <input type="submit" name="upload" value="העלאת תמונה חדשה"/>
                   <?php include("uploadProfile.php"); ?>
                 </form><br>
                  <form action=" " method="POST">
                    <input type="hidden" value="<?php echo "$id"; ?>" name="id">
                    <h2><?php echo "$username";   if (is_store_manage() ) {?>
                      (<?php echo getStoreName($id); ?>) <br>
                    <?  } ?></h2><br><hr width="300px">
                    <p class="myP"><u>שם מלא:</u> <?php echo "$fname $lname"; ?></p><br>
                    <p class="myP"><u>מייל:</u>
                      <input type="text" value="<?php echo "$email"; ?>" name="newEmail"> </p><br>
    				        <p class="myP"><u>מין:</u>
                    <select name="sex">
                      <option selected="" value="<?php echo "$sex"; ?>"><?php echo "$sex"; ?></option>
                      <option value="Male">זכר</option>
                      <option value="Fmaile">נקבה</option>
                    </select></p><br>
                    <p class="myP"><u>אזור מגורים:</u>
                      <select name="city">
                        <option selected="" value="<?php echo "$city"; ?>"><?php echo "$city"; ?></option>
                        <option value="Center">גוש דן והמרכז</option>
                        <option value="South">דרום והשפלה</option>
                        <option value="North">צפון הארץ</option>
                      </select>
                   </p><br><br><br>
                   <hr width="300px">
                   <br>
                   <input type="submit" value="Edit" name="editProfileValues">
               </form>
                  <?php
                    include("editProfileByUser.php");
                  }
                ?>
        </div>

		</div>
</div>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
 ?>

 <script>
   document.title = '<?php echo $username .' ' .profile; ?>';
 </script>
