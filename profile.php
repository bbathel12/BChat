<html>
  <head>
    <?php include('header.php'); ?>
  </head>
  <body>
  <?php
    ini_set('display_error',1);
    session_start();
    include('connection.php');
    
    //change profile stuff
    
    if($_POST['user_name']!="" && $_POST['password']!="" && $_POST['password_copy']!=""){
      if($_POST['password'] == $_POST['password_copy']){
        $change_profile_query = "update users set user_name='".$_POST['user_name'] ."', password = '".$_POST['password']."' where Id='".$_SESSION['user_id']."';";
        $change_profile_query;
        $_SESSION['user_name'] = $_POST['user_name'];
        mysqli_query($con,$change_profile_query);
        
      }
    }
    else if ($_POST['user_name']!=""){
        $change_profile_query = "update users set user_name='".$_POST['user_name'] ."' where Id='".$_SESSION['user_id']."';";
        $change_profile_query;
        $_SESSION['user_name'] = $_POST['user_name'];
        mysqli_query($con,$change_profile_query);
    }

    //Get profile stuff
    $profile_query = "select * from users where Id='". $_SESSION['user_id'] ."'limit 1";
    $profile = mysqli_query($con,$profile_query);
    $profile = mysqli_fetch_assoc($profile);
  ?>
  
<fieldset id=profile>
  <?php include('nav.php'); ?>
  <legend><?php echo ucfirst($profile['first_name']."'s Profile");?></legend>
  <form method=Post action="<?php $_SERVER['PHP_SELF']; ?>">
    <label>User Name:<input type=text name=user_name value="<?php echo $profile['user_name']; ?>" ></label>
    <label>Password:<input type=password name=password></label>
    <label>Retype Password:<input type=password_copy name=password></label>
    <input type="submit">
    
  </form>
</fieldset>
  </body>
</html>
