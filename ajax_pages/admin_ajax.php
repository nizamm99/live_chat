<?php
require_once '../includes/include.php';


$process = $_POST['process'];

if($process == "getFreequentData"){
	$array_current_chat = array();
$array_not_chat_started = array();
$chat = array();

$sql_not_chat_started = mysql_query("SELECT `userid`, `name`, `email`, `question`, `time`, `is_chat_started`, `chat_admin_id` FROM `chat_users` WHERE `is_chat_started`=0 OR `chat_admin_id` is null");

while($result_not_chat_started = mysql_fetch_assoc($sql_not_chat_started)){
	
	$array_not_chat_started[] = $result_not_chat_started;
	
}

$sql_current_chat = mysql_query("SELECT `userid`, `name`, `email`, `question`, `time`, `is_chat_started`, `chat_admin_id` FROM `chat_users` WHERE `chat_admin_id`='2001'");

while($result_current_chat = mysql_fetch_assoc($sql_current_chat)){
	$userid = $result_current_chat['userid'];
	$admin_userid = 2001;
	$sql = mysql_query("SELECT * FROM `chat` WHERE `chat_user_id`= '$userid' AND  `admin_user_id` ='$admin_userid'");
	while($chat_result=mysql_fetch_assoc($sql)){
		$chat[$userid][] = $chat_result;
	}
	$array_current_chat[] = $result_current_chat;
	
} 


$data['current_chat'] = $array_current_chat;
$data['chat'] = $chat;
$data['pending_chat_requests'] =$array_not_chat_started;
$data['status'] = 'success';
$data['message'] = 'this is the message';

echo json_encode($data);
}else if($process == "acceptChat"){
	$userId = $_POST['userid'];
	$accept = mysql_query("update chat_users set chat_admin_id='2001' ,`is_chat_started`=1 where userid='$userId'");
	
}
