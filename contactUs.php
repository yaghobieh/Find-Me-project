<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
include("Includes/header.php");

 if (logged_on()){
   ?>
   <div class="connect" id="distribution">
     <h1><?php echo CONNECT_US_TITLE; ?></h1>
     <hr>
     <form action="" method="post">
       <input type="text" name="name" placeholder="<?php echo $_SESSION['username']; ?>" value="<?php echo $_SESSION['username']; ?>">
       <input type="text" name="Title" placeholder="כותרת">
       <textarea maxlength="500" placeholder="תוכן הודעה" name="contents"></textarea>
       <hr>
       <button name="connectUs" id="connectUs">צור קשר</button>
   </form>
   </div>
   <?
  }

  Include("coonectusFunction.php");
  include ("Includes/footer.php");
?>

<script>
  document.title = '<?php echo CONNECT_US_TITLE; ?>';
</script>
