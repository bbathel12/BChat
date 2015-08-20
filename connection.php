<?php $con = mysqli_connect('localhost','brice','Bbathel1','bchat');
    // checking for mysqli errors.
    if(mysqli_errno($con) > 0 ){
      echo "<p>error " .mysqli_errno($con) ."</p>";
    }?>
    
    
