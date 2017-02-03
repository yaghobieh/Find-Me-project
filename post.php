<?php
require_once  ("Includes/connectDB.php");
        include("Includes/header.php");
        $g = ($_GET['id']);
        if ($g == NULL)
        {
              echo "Cannot send empty id";
              die();
        }
        else {

        if (isset($_POST['submit']))
        {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $contents = $_POST['contents'];
        $userWrite= $_SESSION['username'];
        $gID = $g ;
        $query = "INSERT INTO response (title, subtitle, contents, itemID, userWrite) VALUES (?, ?, ?, ?, ?)";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('sssss', $title, $subtitle, $contents, $gID, $userWrite);
        $statement->execute();
        $statement->store_result();

        if ($statement->error)
        {
            die('Database query failed: ' . $statement->error);
        }

        $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful)
        {
            echo "<div class='eror'>תודה על פרסום המודעה/ התגובה דעתכם חשובה לנו<br>בהתאם לתקנון המערכת, הפוסט יעלה בעוד 48 שעות</div>";
            ?><script>parent.history.back();</script><?
        }
        else
        {
            echo "<div class='eror'>התרחשה שגיאה בלתי צפוייה<br>אנא בדוק שהינך מחובר או שרשמת את הפרטים נכון!</div>";
        }
   }
            if (logged_on()) {
                            echo "{$_SESSION['username']}";
        }
        }

?>

<!DOCTYPE html>
<html lang="en"> <!---CSS IN REG_TMP.CSS-->
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <div class="containers">
        <form method="post" action="">
כותרת:<input type="text" id="title" name="title" maxlength=15  placeholder="כותרת" required=""><br />
כותרת משנה:<input type="text" id="subtitle" name="subtitle" maxlength=15 placeholder="כותרת" ><br />
תוכן:<br> <br /><textarea name="contents" maxlength=40 class="textarea" placeholder="תוכן התגובה" required=""></textarea><br />
<input type="submit" value="שלח תגובה!" name="submit" />
            </form>
    </div>

    </body>

</html>
