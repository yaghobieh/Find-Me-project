<?php
  require_once ("Includes/simplecms-config.php");
  require_once  ("Includes/connectDB.php");
  include("Includes/header.php");
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

</head>
<body>
     <!----Pics Div center CSS:Between---->
    <a href="#top"></a><br>
    <center><div class="displayCat" id="displayCat">
    </div></center>
    <center><div class="displayCat_big" id="displayCat_big">
    </div></center>
      <?php

        $statement = $databaseConnection->prepare("SELECT id, menulabel, division_num, imgFront FROM pages");
        $statement->execute();
          if($statement->error)
          {
           die("Database query failed: " . $statement->error);
          }
         $statement->bind_result($id, $menulabel, $division_num, $imgFront);
         while($statement->fetch())
         {
           if ($division_num == 'true'){
              ?>
                <script>
                  var $div = $('<div class="displayCat_Inline">');
                  var $divTitle = $('<div class="displayCat_Title">');
                  var $divImage = $('<div class="displayCat_images">');
                  var $img = $('<img>');
                  var $href = $('<a>');

                  $href.attr('href', 'page.php?pageid=<?php echo $id; ?>');
                  $href.text('<?php echo $menulabel; ?>');
                  $divTitle.append($href);
                  $img.attr('src', '<?php echo $imgFront; ?>');
                  $divImage.append($img);

                  $div.append($divTitle);
                  $div.append($divImage);

                  $('#displayCat').append($div);
                </script>
              <?
            }
            if ($division_num == 'false'){
              ?>
              <script>
                var $div = $('<div class="displayCat_Inline_big">');
                var $divTitle = $('<div class="displayCat_Title_big">');
                var $divImage = $('<div class="displayCat_images_big">');
                var $img = $('<img>');
                var $href = $('<a>');

                $href.attr('href', 'page.php?pageid=<?php echo $id; ?>');
                $href.text('<?php echo $menulabel; ?>');
                $divTitle.append($href);
                $img.attr('src', '<?php echo $imgFront; ?>');
                $divImage.append($img);

                $div.append($divTitle);
                $div.append($divImage);

                $('#displayCat_big').append($div);
              </script>
              <?
            }
          }

      ?>
</body>
</html>
<?php
  include ("Includes/footer.php");
?>
