<?php include('connection.php');
          $count_query = "SELECT COUNT(message) FROM chats";
          $chat_count = mysqli_query($con,$count_query );
          $chat_count = mysqli_fetch_row($chat_count);
          $start = $chat_count[0]-100 > 0 ? $chat_count[0]-100 : 0;
          //echo "Start $start<br>";
          $end = $chat_count[0];
          //echo "End $end<br>";
          if(isset($_GET['lastMessage'])){
                      $start = $_GET['lastMessage'];
         }   
          if(($end - $start) > 0){
                
                //Gets 1000 latest chats
                $get_chats = "select  users.user_name, chats.message, chats.Id,chats.CreatedOn from chats inner join users on chats.ownerId=users.Id order by chats.Id limit ".$start.",".$end;
                //Gets chats from up to two seconds ago
                /*
                $start = strtotime('-1 seconds');
                $start =  date('Y-m-d G:i:s', $start);
                $end = date('Y-m-d G:i:s');
                $get_chats = "select users.user_name, chats.message, chats.Id, chats.CreatedOn from chats inner join users on chats.ownerId=users.Id where chats.CreatedOn between '$start' and '$end' order by chats.Id";
                */
                $result = mysqli_query($con,$get_chats);
                
                $json = "{";
              
                      while( $row = mysqli_fetch_assoc($result)){
                        //echo htmlspecialchars($row['message']);
                        $message = str_replace("\\","",$row['message'] );
                        $message = str_replace("\"",'\"',$message);
                        $json .= "\"$row[Id]\":{\"username\":\"$row[user_name]\",\"message\":\"".$message."\",\"chatId\":$row[Id],\"time\":\"$row[CreatedOn]\"},";
                      }
                      $json = substr($json,0,strlen($json)-1);
                $json .= "}";
      
                echo $json;
         }else
         { echo -1;}

    
