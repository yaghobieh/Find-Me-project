<?php require_once ("Includes/session.php");
      include ("Includes/functions.php");
      include ("lang/definePages.php");
      include ("lang/titles.php");
  ?>
<html>
    <head>
        <title><?php echo TOP_TITLE; ?></title>
        <!--META Links-->
        <meta charset="utf-8" />
        <!--CSS Links-->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    	  <link rel="stylesheet" type="text/css" href="/findme/css/otherOptions.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/profile.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/bodySyles.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/connect.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/searchForm.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/control_c.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/editorController.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/registration.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/footer.css" />
        <link rel="stylesheet" type="text/css" href="/findme/css/pages.css" />
        <link type="text/css" rel="stylesheet" href="/findme/css/overlaypopup.css" />
        <link type="text/css" rel="stylesheet" href="/findme/css/nav.css" />
        <link type="text/css" rel="stylesheet" href="/findme/css/business.css" />
        <link type="text/css" rel="stylesheet" href="/findme/css/termOfUse.css" />
        <link type="text/css" rel="stylesheet" href="/findme/css/storeMap.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
        <!--Scripts Links-->
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script type="text/javascript" src="/findme/scripts/openPopoutDivs.js"></script>
        <script type="text/javascript" src="/findme/scripts/toggle.js"></script>
    </head>
<body ng-app>
  <div class="LogoandMore">
    <div class="logo"><img src="images/logofindme2.png"></div>
    <div class="ser">
      <form class="search" method="post" action="search.php">
          <input type="search" name="whatYouSearcing" id="keyword" class="mySearch"
                placeholder="אני מחפש..." autocomplete="off">
          <ul class="search-ac" id="search-ac">

          </ul>
        </form>
    </div>
    <script>
      $('document').ready(function(){
        $('#keyword').keyup(function(){
          var searchValGetted = $('#keyword').val();
            $.post("searchResult.php", {searchVal: searchValGetted}, function(data){
              $('.search-ac').html(data);
            });
        });
      });

    </script>
    <div class="side-social-networks">
      <img src="img/facebookIcon.jpg">
      <img src="img/linkedinIcon.jpg">
      <img src="img/reddit.jpg"><br>
      <img src="img/StumbleUponIcon.jpg">
      <img src="img/twitterIcon.jpg">
      <img src="img/googlePlusIcon.jpg">
    </div>
    <div class="ser-manu-open">
      <!----Can to add in side of the menu (left side)--------->
    </div>
    <br><br>
      <div id='cssmenu'>
      <ul>
         <?PHP if (!(logged_on())) echo "<li><a class='show-popup' href='#' data-showpopup='1' ><span>התחברות</span></a></li>" ; ?>
          <?php
           $counter;
           $statement = $databaseConnection->prepare("SELECT id, menulabel, setIt FROM pages");
           $statement->execute();
           if($statement->error)
               {
                  die("Database query failed: " . $statement->error);
                }
                $statement->bind_result($id, $menulabel, $setIt);
                while($statement->fetch())
                {
                    $getIt = ($_GET['$setIt']);

                    if ( $setIt == 'true' && $counter <= 10){
                      $counter++;
                      echo "<li><a href=\"page.php?pageid=$id\"><font color='black'>$menulabel</font></a></li>\n";
               }
            }

        ?>
     <li><a href='index.php'>עמוד ראשי</a></li>
    </ul>
  </div>

</div>
<br><br>
<div class="CoverUsearManual" >
      <div class="userManual">
      <?php
      if (logged_on()) {
        if (!is_admin() && !is_store_manage()){
            echo "בעל עסק? <a href='regnewbusiness.php'><font color='#8E9191'>פתח חנות משלך</font></a>";
        }
        else{
            include ("Includes/storeClass.php");
            echo "<font color='#2A94B8'><b>Manage: </b></font>";
            $getStoreID = getStoreID($_SESSION['userid']);
            $getStoreName = getStoreName($_SESSION['userid']);
            echo "<a href='stores.php?storeid=$getStoreID'>$getStoreName</a>";
          }
          echo "<div class='Welcome'> <a href='logoff.php'>(התנתק)</a>  <strong><a href='profile.php?username={$_SESSION['username']}'>{$_SESSION['username']}</a></strong> :ברוך הבא </div>\n";
        }
        if (logged_on())
        {
          if (is_admin())
            {
                ?>
                <a href="control.php" class="icon-home">פאנל ניהול</a> &#8500;
                 <nav id="opSide">
                     <ul>
                       <li>
                         <img src="img/arrow-down.png">
                         <ul>
                           <li><a href="additem.php">הוסף מוצר</a></li>
                           <li><a href="addpage.php">הוסף עמוד</a></li>
                           <li><a href="selectpagetoedit.php">ערוך עמוד</a></li>
                           <li><a href="selectitem.php">ערוך מוצר</a></li>
                           <li><a href="selectuser.php">ערוך משתמש</a></li>
                         </ul>
                       </ul>
                       </nav>
                <?
             }
        }
      if (!logged_on()) {
        echo "<b>שלום אורח</b> <a href='register.php'>הרשמה</a> | <a href='logon.php'> התחברות</a>\n";
      }
      ?>
    </div>
  </div>

</div>
<!-- Popup Pages -->
<div class="overlay-bg">
</div>
<div class="overlay-content popup1">
  <div class="distribution"><!-- Connect If push the התחברות  content-->
    <h1>התחברות מהירה</h1>
    <form name="login-form" class="login-form" action="logon.php" method="post">
  <input name="username" type="text" class="input username" placeholder="User Name" />
  <input name="password" type="password" class="input password" placeholder="Password" />
<br>
<font color="silver"><b>במידה ואינך רשום</b></font><a href="register.php">הרשם כעת</a><br>
<input type="submit" name="submit" value="התחברות" class="button" /><hr></form>
</div>

</div>
</body>
</html>
