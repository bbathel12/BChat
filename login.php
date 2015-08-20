<?php
    if(isset($_POST['username']) && isset($_POST['pwd'])){
      $user_query = "select * from users where first_name='".$_POST['username']."' and password='".$_POST['pwd']."'";
      
      $user = mysqli_query($con,$user_query);
      $user = mysqli_fetch_row($user);
      if($user != 0){
        $_SESSION['logged_in'] = true;
        $_SESSION['user_name'] = ucfirst($user[1]);
        $_SESSION['user_id'] = $user[0];
      }
    }
  ?>
  