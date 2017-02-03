<?php
    include("Includes/header.php");

    /*$myfile = fopen("documents\TermOfUsers.txt", "r") or die("Unable to open file!");
    $getDocuments = fread($myfile, filesize("documents\TermOfUsers.txt"));
    fclose($myfile);*/
    ?><div class="top-read">
      <p>תנאי השימוש באתר Find-Me</p>
      <div class="inside-text"><?

    $row = 1;
    if (($handle = fopen("documents\TermOfUsers.txt", "r")) !== FALSE) {
    while (($data =  fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo iconv(mb_detect_encoding($data[$c], mb_detect_order(), true), "UTF-8", $data[$c]) . "<br />\n";
        }
    }
  }
  ?> <h2>תודה לזאפ על התקנון, העבודה הזו הינה לצרכי פרוייקט גמר בלבד ואין הכוונה לגנוב או לפגוע באתר זאפ. כל הזכויות שמורות לזאפ</h2> </div>
</div><?
    fclose($handle);
    include("Includes/footer.php");
?>
<script>
  document.title = '<?php echo tremOfUsers; ?>';
</script>
