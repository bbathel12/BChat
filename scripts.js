    var updateChat = function(data){
    // gets json from get_chats.php sends the last chat id updated on the page.
      if (data != -1) {
          messages = JSON.parse(data);
          var message=""
          for(var number in messages) {
            message += '<div class="message_holder ' + messages[number]['username']+ '"><span class="message ">' + messages[number]['username']+'('+messages[number]['time'].substring(11,16)+'):'+ messages[number]['message']+'</span></div>'
            window.lastMessageNumber +=1
          }
          $(message).insertBefore($('#ChatBox div#end'))
     document.getElementById('Ding_Sound').play();
	$('#chatbox').scrollTop($('#chatbox')[0].scrollHeight);
      }
    }
    
    /*
     *!!!!!!!!message format
     *<div class="message_holder">
     *  <span class="message amber">
     *    amber: Yeah, I guess you just pick one that you like or one that has special meaning
     *  </span>
     * </div>
     *
     *!!!!!!!!Data format
     *"603":{"username":"brice","message":"Amber are you a fucking cop","chatId":603,"time":"2015-08-05 14:57:26"}
     * 
    */
    //$("#chatbox div").load("/chat/get_chats.php #Chats");
    //$('#chatbox').scrollTop($('#chatbox div').height())
  
  
  var sendchat = function(user_id){
    if ($('#ChatForm input[type=text]').val().length > 0) {
      new_chat = {"user_id":user_id,"message" : $('#ChatForm input[type=text]').val() }
      $('#ChatForm input[type=text]').val("");
      $.get('/chat/add_chat.php',new_chat);
      $.get("/chat/get_chats.php?lastMessage="+lastMessageNumber,function(data){message = data;updateChat(data)})
    }
  }
  
  
  var update_users = function(data){
    jQuery('#users_holder').remove();
    var users = "<div id='users_holder'>";
    var logged_in = "";
    for (values in data) {
      if (data[values][1]==1) {
        logged_in = "<span class='dot green-dot'></span>";
      }
      else{
        logged_in = "<span class='dot red-dot'></span>";
      }
      users += "<div>" + data[values][0] + " "+ logged_in + "</div>";
    }
    users += "</div>"
    users = jQuery(users);
    jQuery('#users').append(users);
    

  }
  
