<?php
require_once ("Includes/connectDB.php");
require_once ("Includes/session.php");

    ?><footer class="style"><div class="info_footer">
      <p><b>© 2016 FindMe, Inc. All rights reserved.</b>&nbsp;&nbsp;&nbsp;&nbsp;</p>
      <?
$sql = "SELECT * FROM footer_links";
$result = $databaseConnection->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
          <li><a href="<?php echo $row['linkAdress']; ?>"><?php echo $row['lineA_name'];?> </a> &#8500;
        <?
    }
  }
?>
  </div></div>
<html>
<head>
 </head>
    <body>
        <br>
         <a href="#top" class="scrollToTop"></a>
         <a href="#" class="overToMail" data-showpopup='2' id="overToMail">רשימת תפוצה <img src="img/chat-icon.png"></a>
              <script>
              $(document).ready(function(){

                //Check to see if the window is top if not then display button
                $(window).scroll(function(){
                  if ($(this).scrollTop() > 100) {
                    $('.scrollToTop').fadeIn();
                    $('.overToMail').fadeIn();
                    $('.side-social-networks').fadeOut();
                  } else {
                    $('.scrollToTop').fadeOut();
                    $('.overToMail').fadeOut();
                    $('.side-social-networks').fadeIn();
                  }
                });

                //Click event to scroll to top
                $('.scrollToTop').click(function(){
                  $('html, body').animate({scrollTop : 0},1000);
                  return false;
                });

                });
              </script>

          <div class="overlay-content popup2">
            <div class="distribution" id="distribution">
              <h1><?php echo DISTRIBUTION_TITLE;?></h1>
              <hr>
              <form action="" method="post">
                <input type="email" name="email" placeholder="Enter your mail">
                <input type="text" name="fullname" placeholder="Enter Your name">
                <hr>
                <button name="addMe" id="addMe">הוסף אותי לרשימה</button>
            </form>
            </div>
          </div>

        <?php
          include("addToDistribition.php"); ?>
    </body>
</html>
