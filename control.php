<?php
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php");
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");
    /********************************************/
    if (is_admin()){
      ?>
      <br>
      <center>
      <nav id="top-menu-controller">
        <ul>
          <li>
          &#x2045;  <a href="control.php" class="icon-home">עריכה</a> &#x2046;
            <ul>
               <li><a href="selectpagetoedit.php">ערוך קטגורייה</a>
               <li><a href="selectitem.php">ערוך מוצר</a>
               <li><a href="selectStore.php">ערוך חנות</a>
               <li><a href="selectuser.php">ערוך משתמש</a>
            </ul>
        </ul>
        <ul>
          <li>
              &#x2045; <a href="control.php" class="icon-home">הוספה</a> &#x2046;
            <ul>
               <li><a href="addpage.php">צור קטגורייה</a>
               <li><a href="additem.php">צור מוצר</a>
            </ul>
        </ul>
        <ul>
          <li>
              &#x2045; <a href="control.php" class="icon-home">סטטיסטיקות</a> &#x2046;
            <ul>
               <li><a href="statisticOfUpdateReg.php">נרשמים לעדכונים</a>
               <li><a href="statisticOfReportes.php">דווחים</a>
               <li><a href="statisticConnect.php">יצירת קשר</a>
            </ul>
        </ul>
        <ul>
          <li>
            &#x2045; <a href="control.php" class="icon-home">מחיקה</a> &#x2046;
            <ul>
              <li><a href="deletepage.php.php">מחק קטגורייה</a>
              <li><a href="deleteitem.php">מחק מוצר</a>
              <li><a href="deleteStore.php">מחק חנות</a>
            </ul>
        </ul>
        <ul>
          <li>
             &#x2045; <a href="control.php" class="icon-home">לינקים</a> &#x2046;
            <ul>
              <li><a href="editfooter.php">ערוך חלק תחתון</a>
              <li><a href="index2.php">בקר באינדקס מבקרים</a>
            </ul>
        </ul>
      </nav>

      <br>
      <a href="#" id="plus-info">+</a>
      <div class="info-topfive">
        <div class="inside">
          <p>Last new users:</p>
          <?php Include("lastReggistUsers.php"); ?>
        </div>
        <div class="inside">
          <p>Last new Stores:</p>
          <?php Include("lastNewStores.php"); ?>
        </div>
        <div class="inside">
          <p>Last new Items:</p>
          <?php Include("lastNewItems.php"); ?>
        </div>
      </div>
      <br>

      <a href="#" id="plus-info-tabs">+</a>
      <div class="control_panle_Style">
        <ul class="tabs">
          <li class="labels">
              <label for="tab1" id="label1">items</label>
              <label for="tab2" id="label2">Stores</label>
              <label for="tab3" id="label3">All</label>
          </li>
          <li>
              <input type="radio" checked name="tabs" id="tab1">
              <div id="tab-content1" class="tab-content">
                  <h3>Waiting Items Response</h3>
                  <iframe src="waitingresponseitems.php" height="900px"></iframe>
              </div>
          </li>
          <li>
              <input type="radio" name="tabs" id="tab2">
              <div id="tab-content2" class="tab-content">
                  <h3>Waiting store Response</h3>
                  <iframe src="waitingresponse.php" height="900px"></iframe>
              </div>
          </li>
          <li>
              <input type="radio" name="tabs" id="tab3">
              <div id="tab-content3" class="tab-content">
                  <h3>Response Edit</h3>
                  <iframe src="allResponse.php" height="900px"></iframe>
              </div>
          </li>
      </ul>
    </div></center><br>
    <script>
    $( "#plus-info" ).click(function() {
        $( ".info-topfive" ).toggle();
    });

    $( "#plus-info-tabs" ).click(function() {
        $( ".control_panle_Style" ).toggle();
    });
    </script>
 <?PHP }
 else
    echo "<div class='eror'>אינך בהרשאות המתאימות בכדי להוסיפך עמוד</div>";
    include ("Includes/footer.php");
?>

<script>
  document.title = '<?php echo CONTROL_PANEL; ?>';
</script>
