<?php

$link = @mysql_connect($database['host'], $database['user'], $database['password']);
$db = @mysql_select_db($database['password'], $link);

