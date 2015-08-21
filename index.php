<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="/chat/scripts.js"></script>
  <link rel="stylesheet" href="/chat/chat.css">
  <?php include('header.html'); ?>
  <?php
    ini_set('display_errors',1);
    session_start();
    $logged_in = isset($_SESSION['logged_in']) ? true : false ;
    
    //connection
    include('connection.php');
    
    
    //include('login.php');
      if(isset($_POST['username']) && isset($_POST['pwd'])){
      $user_query = "select * from users where first_name='".$_POST['username']."' and password='".$_POST['pwd']."'";
      $user = mysqli_query($con,$user_query);
      $user = mysqli_fetch_row($user);
      if($user != 1){
        $_SESSION['logged_in'] = $logged_in = true;
        $_SESSION['user_name'] = ucfirst($user[2]);
        $_SESSION['user_id'] = $user[0];
      }
    }
    
    
      
    
  ?>
</head>
<body>

<?php if ($logged_in == false){ ?>
  <fieldset><legend>Login</legend>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <label>User Name: <input type="text" name=username></label>
      <label>Password: <input type="password" name=pwd></label>
      <input type="submit" value="Login">
    </form>
  </fieldset>
<?php }else { include('nav.php'); ?>
  <fieldset><legend>Welcome to Chat <?php  echo $_SESSION['user_name'];?> </legend>
  
  <div id="chatbox"><div>
    
  </div><div id="end"></div>
</div>
  
  <form id=ChatForm method=get action="add_chat.php">
    <input type=text name="message">
    <input type=hidden name="user_id" value=1>
    <input type=submit value="Send >>>">
  </form></fieldset>
  
  <script>
    window.lastMessageNumber = 0;
    var message;
  $(document).ready(function(){
    var chatbox = $("#chatbox");
    //sends chat on submit
    $("#ChatForm").submit(function(event){event.preventDefault();sendchat(<?php echo $_SESSION['user_id'];?>)})
    //gets chats every 2 seconds
    setInterval(function () {$.get("/chat/get_chats.php?lastMessage="+window.lastMessageNumber,function(data){message = data;updateChat(data);$('.message_holder').last().children().emoticonize(true);})},2000);
    //sends login signal every 30 seconds
    $.get("logged_in.php?logged_in=true&user_id=<?php echo strtolower($_SESSION['user_id']);?>");
    //sets up mute button
    $('#mute').click(function(){
      var sound = document.getElementById('Ding_Sound')
      if (sound.muted){
        sound.muted = false;
        sound.volume=.5;
        $(this).text('mute')
      }else{
        sound.muted = true;
        $(this).text('unmute')
      }
    })
    
    //logs out on onload
    $(window).bind('beforeunload', function() { 
            $.get("logged_in.php?logged_in=false&user_id=<?php echo strtolower($_SESSION['user_id']);?>");
        } 
    );
    
    setInterval(function(){$.getJSON("logged_in.php",function(data){update_users(data)})},25000);
  })
  
  </script>
  <style>
    div.<?php echo strtolower($_SESSION['user_name']);?>{
      background-color:rgba(0,255,255,1);
      float:right;
    }
  </style>
  </style>
<?php }?>

<audio src="74421^Ding.mp3" id="Ding_Sound" style="display:none;"></audio>
  <div id="users"></div>
<?php include('footer.php');?>
</body>

</html>

