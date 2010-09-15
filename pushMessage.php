#!/usr/bin/php
<?php
// include the ProwlPHP stuff
include('ProwlPHP.php');
		
/******************************
 SET HERE YOUR PERSONAL API KEY
 ******************************/
$apikey = 'YOUR API KEY';

if($argv[1] == null)
{
	echo "You must enter a message to push\n";
}
else
{
	$msg_string = '';
	
	foreach($argv as $msg)
	{
		if (strcmp($argv[0], $msg) == 0) continue;
		$msg_string = $msg_string." ".$msg;
	}
	pushNotification($msg_string, $apikey);
}

function pushNotification($msg, $apikey)
{
	$prowl = new Prowl($apikey);
	$prowl->push(array(
                'application'=>'GIZ.me Notification',
                'event'=>'',
                'description'=>$msg."\n".date('H:i:s'),
                'priority'=>0,
           		),true);
}
?>