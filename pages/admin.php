<?php

?>
<style type="text/css">
#chatDiv{
	border: 1px solid black;
	min-height:300px;
}
</style>

<div id="pending_chat_requests"> </div>
<div id="current_chat"> </div>
<div id="current_chat_log"> </div>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(
function(){
	chatAdmin();
	$("#startChat").on("click",function(){
		$("#chatDiv").show();
	});
	
	$("#pending_chat_requests").on("click", ".accept_chat_requests", function(){
		var chatId = $(this).attr("data-userid");
		acceptChat(chatId);
	});
	 
}
);

function chatAdmin(){
	//alert("sss");
	$.ajax({
  url: "admin_ajax.php",
  context: document.body,
  data:{process : "getFreequentData"},
  type: "POST"
}).done(function(return_data) {
  //alert(data);
  $data = $.parseJSON(return_data);
  var pending_chat_requests = $data['pending_chat_requests'];
  var pending_chat_requests_html = "<h1> Pending Chat </h1>";
  $.each(pending_chat_requests, function(key, value){
   pending_chat_requests_html = pending_chat_requests_html + "<a href='javascript:void(0)' class='accept_chat_requests' data-userid='"+  value.userid +"' >  "+ value.name +  "  " +  value.userid +" </a> <br />";
  });
  $("#pending_chat_requests").html(pending_chat_requests_html);
  var current_chat = $data['current_chat'];
  var current_chat_html = "<h1> Current Chat </h1>";
  $.each(current_chat, function(key, value){
   current_chat_html = current_chat_html + "<a href='javascript:void(0)' class='accept_chat_requests' data-userid='"+  value.userid +"' >  "+ value.name +  "  " +  value.userid +" </a> <br />";
  });

  $("#current_chat").html(current_chat_html);
  
  
  var current_chat_log=$data['chat'];
  var chat_user_html = "";
  $.each(current_chat_log, function(userid, chat_users){
	 
	  chat_user_html = chat_user_html + "<div >";
	  $.each(current_chat_log, function(key, value){
		    console.log(value.message);
			//alert(value);
	  });
	  chat_user_html = chat_user_html + "</div>";

  });
 
}).fail(function() {
   // alert( "error" );
  })
  .always(function() {
    //alert( "complete" );
  });
	setTimeout('chatAdmin()',3000);
}

function acceptChat(chatId){
	$.ajax({
  url: "admin_ajax.php",
  context: document.body,
  data:{process : "acceptChat",userid:chatId},
  type: "POST"
}).done(function(data) {
	chatAdmin();
 // $("#pending_chat_requests").html(pending_chat_requests_html);
  
}).fail(function() {
   // alert( "error" );
  })
  .always(function() {
    //alert( "complete" );
  });
}
</script>