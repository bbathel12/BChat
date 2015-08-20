
    <?php
    //this inserts the new chat
      ini_set('display_errors',1);
      if(isset($_GET['message'])){
        include('connection.php');
        $update_chat = "insert into chats (ownerId,message) values ('".$_GET['user_id']."','".addslashes($_GET['message'])."')";
        mysqli_query($con, $update_chat);
      }
      
      
      
    ?>

    
    
    