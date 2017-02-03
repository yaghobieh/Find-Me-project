<?php
    include("Includes/header.php");

    if (is_admin()){
    ?><div class="top-read">
      <p><?php echo Statistic_ConnectUs_InTitle; ?></p>
      <div class="inside-text-statistic"><?

    $row = 1;
    if (($handle = fopen("documents\connectUs.txt", "r")) !== FALSE) {
    while (($data =  fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo "<li>" .iconv(mb_detect_encoding($data[$c], mb_detect_order(), true), "UTF-8", $data[$c]) . "<br />\n";
        }
    }
  }
  ?></div>
</div><?
    fclose($handle);
  }
    include("Includes/footer.php");
?>
<script>
  document.title = '<?php echo Statistic_ConnectUs; ?>';
</script>
