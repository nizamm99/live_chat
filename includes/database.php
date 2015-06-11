<?php

$link = mysql_connect($database['host'],$database['user'],$database['password']) or die('Connection Failed');
$db = mysql_select_db($database['database'],$link) or die('Failed to connect database');

