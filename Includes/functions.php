<?php
function myRefresh ($link)
{
   echo "<script>
            window.location = '$link'
        </script>";
}

function CheckPass ($pass1, $pass2)
{
    if ( $pass1 == $pass2 )
    {
      $pass1 = $_POST['password'];
      return $pass1;
    }
    else {
      echo "<div class='eror'>הסיסמאות אינן תואמות, נסה שוב</div>";
      myRefresh ("register.php");
      die();
    }
}

function SendRegMail ($email)
{
  $subject = "תודה שנרשמת ל-Find Me";
  $headers = array(
  "From: " . "mennage@findme.co.il",//כתובת השולח,
  "Reply-To: " . "abc@def.co.il",//להיכן להשיב
  "Content-Type: text/html; charset=utf-8",//בשביל עברית,
  "MIME-Version: 1.0",//MIME,
  "X-Mailer: PHP/" . PHP_VERSION
  );
  $headers = implode("\r\n", $headers);
  $message = '<html lang="he-IL">';
  $message .= '<head><meta charset="utf-8"></head>';
  $message .= '<body dir="rtl" style="width:97%;margin:10px auto;padding:0;color:#990033;font-size:2em;line-height:2;font-family:Arial,Helvetica,sans-serif;">';
  $message .= '<div style="border:1px solid #339900;">';
  $message .= '<div id="header" style="background:#33FF00;border-bottom:1px solid #339900;">';
  $message .= '<div style="padding:20px;text-align:center;width:50%;margin:0 auto;">';
  $message .= '<h1>ברכות לשנה החדשה</h1>';
  $message .= '</div>';
  $message .= '</div>';
  $message .= '<div style="width:100%;background:#ffffff;">';
  $message .= '<div style="width:100%;margin-right:20px;">';
  $message .= '<p>שלום לכולם,</p>';
  $message .= '<p>רציתי לאחל שנה טובה ומוצלחת</p>';
  $message .= '<p style="text-align:center;">';
  $message .= '<img src="http://www.yoursite.co.il/new_year.jpg" alt="שנה טובה" style="width:auto;height:auto;border:1px solid #339900;" />';
  $message .= '</p>';
  $message .= '<p>מיוסי.</p>';
  $message .= '</div>';
  $message .= '</div>';
  $message .= '<div id="footer" style="background:#33FF00;border-top:1px solid #339900;">';
  $message .= '<div style="padding:20px;text-align:center;width:50%;margin:0 auto;">';
  $message .= '<a href="http://www.yoursite.co.il" style="font-size:0.8em;">האתר שלי';
  $message .= '</div></div></div>';
  $message .= '</body></html>';

  mail($to, $subject, $message, $headers);
}
?>
