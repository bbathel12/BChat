<?php

include('connection.php');
if(isset($_GET['logged_in'])){
  if($_GET['logged_in'] == "true"){
    $query = "update users set logged_in=1 where Id=".$_GET['user_id']."";
    mysqli_query($con,$query);
  }else{
    $query = "update users set logged_in=0 where Id=".$_GET['user_id']."";
    mysqli_query($con,$query);
  }
}else{
  $query = "Select * from users";
  $result = mysqli_query($con,$query);
  $people= '{';
  $i = 0;
  while($row = mysqli_fetch_assoc($result) ){
    $people .= '"'.$i++.'":["'.$row['user_name'].'" , '.$row['logged_in'].'],';
  }
  $people = substr($people,0,strlen($people)-1).'}';
  echo $people;
}
?>