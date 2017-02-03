<?php

  if (isset($_POST['addMe'])){

    $fullName= $_POST['fullName'];
    $emailAdress= $_POST['email'];

    $filename = "documents/distributionReg.txt";

    $handle = fopen($filename, "a");
    fwrite($handle, 'Full name: ' );
    fwrite($handle, $fullName );
    fwrite($handle, 'Email adress: ' );
    fwrite($handle,  $emailAdress . PHP_EOL);

    fclose($handle);
  }

?>
