<html>
  <body>
    <?php
      ini_set('display_errors',1);
      session_start();
      session_destroy();
      unset($_SESSION);
      header('location:/chat/')
    ?>
  </body>
  
  </html>
