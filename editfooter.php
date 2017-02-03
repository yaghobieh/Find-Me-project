<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
include("Includes/header.php");

if (is_admin()){
  ?>
  <div class="containers">
    <h1>הוסף לינק חדש</h1>
    <form action="" method="post">
    <input type="hidden" id="id" name="id"/>
    <input type="text" id="lineA_name" name="lineA_name" placeholder="שם הקישור"/>
    <input type="text" id="linkAdress" name="linkAdress" placeholder="כתובת קישור"/>
    <input type="text" name="under_propertie"id="under_propertie" placeholder="מספר עמודה"/><br><br>
    <input type="submit" name="addLink" value="הוסף לינק חדש" />
  </form>
</div><br>
<?
  $sql = "SELECT * FROM footer_links ORDER BY id";
  $result = $databaseConnection->query($sql);
    if ($result->num_rows > 0) {
      ?> <div class="containers">
        <h1>ערוך לינקים קיימים</h1><?
      while($row = $result->fetch_assoc()) {
        ?>
            <ol>
                <li>
                    <form action="" method="post">
                    <br>
                    <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />
                    <input type="text" id="under_propertie" name="under_propertie" value="<?php echo $row['under_propertie']; ?>" />
                    <input type="text" id="lineA_name" name="lineA_name" value="<?php echo $row['lineA_name']; ?>" />
                    <input type="text" name="linkAdress" value="<?php echo $row['linkAdress']; ?>" id="linkAdress" /><br><br>
                    <input type="submit" name="submit" value="ערוך לינק זה" />
                    <input type="submit" name="deleteLink" value="מחק לינק זה" />
                  </form>
                    <br><br><hr>
                </li>
              </ol>
        <?
      }
      ?></div><?
    }
    if (isset($_POST['submit'])){
        $idForEdit = $_POST['id'];
        $nameOfTheLink = $_POST['lineA_name'];
        $linkeAdress = $_POST['linkAdress'];
        $under_propertie = $_POST['under_propertie'];

        $query = "UPDATE footer_links SET lineA_name=?, linkAdress = ?, under_propertie =? WHERE id = ?";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('sssd', $nameOfTheLink, $linkeAdress, $under_propertie, $idForEdit);
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
            ?><script>window.location.reload();</script><?
        }
      }

      if (isset($_POST['deleteLink'])){
          $idForDelete = $_POST['id'];

          $query = "DELETE FROM footer_links WHERE id = ?";

          $statement = $databaseConnection->prepare($query);
          $statement->bind_param('s', $idForDelete);
          $statement->execute();
          $statement->store_result();

          if ($statement->error)
          {
              die('Database query failed: ' . $statement->error);
          }

          $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
          if ($creationWasSuccessful)
          {

              echo "<div class='eror'>לינק זה אוסר בהצלחה</div>";
              ?><script>window.location.reload();</script><?
          }
        }

      if (isset($_POST['addLink'])){
        $newLinkName = $_POST['lineA_name'];
        $newLinkPath = $_POST['linkAdress'];
        $newUnderLink = $_POST['under_propertie'];

        $addNewLinkQuery = "INSERT INTO footer_links (lineA_name, linkAdress, under_propertie) VALUES (?, ?, ?)";

        $statement = $databaseConnection->prepare($addNewLinkQuery);
        $statement->bind_param('sss', $newLinkName, $newLinkPath, $newUnderLink);
        $statement->execute();
        $statement->store_result();
      }
        if ($statement->error)
        {
            die('Database query failed: ' . $statement->error);
        }

        $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful)
        {
            echo "<div class='eror'>עמוד זה נערך כראוי, תודה רבה!</div>";
        }
        else
        {
          echo "<div class='eror'>אופס! ישנה טעות במילוי הטופס או באחד הפרטים נסה שוב</div>";
        }

    }else{
      echo "<div class='eror'>אין לך מספיק הרשאות בכדי שתוכל להשתמש בעמוד זה</div>";
    }
include ("Includes/footer.php"); ?>

<script>
  document.title = '<?php echo EDIT_FOTTER; ?>';
</script>
