<?php
// include the ProwlPHP stuff
include('ProwlPHP.php');

date_default_timezone_set('Europe/Berlin');
		
/******************************
 SET HERE YOUR PERSONAL API KEY
 ******************************/
$apikey = 'YOUR API KEY';

// set the retry counter in seconds
$retry = 60;
$online = false;

//start the checking daemon
run($retry, $online, $apikey);

function run($retry, &$online, $apikey)
{		
	// check online status until the club room is online
	while(checkStatus($retry, $online, $apikey) == "0")
	{
		$online = false;
		sleep($retry);
	}
	
	$online = true;
	
	// start the idle daemon until the club room is offline again
	idleUntilOffline($retry, $online, $apikey);
}

function idleUntilOffline($retry, $online, $apikey)
{
	while($online)
	{
		//sleep for 1 hr and check again
		sleep(600);
		run($retry, $online, $apikey);
		return;
	}
}

function checkStatus($retry, $online, $apikey)
{
	// load the XML status file from the website
	$flagXML =  @simplexml_load_file('http://c3t.de/club/flag.xml');
	$status = $flagXML->status[0];
	
	if($status == '1' && $online == false)
	{
		//trigger the 'club is online' event
		pushNotification($apikey);
	}
	return $status;
}

function pushNotification($apikey)
{
	$prowl = new Prowl($apikey);
	$prowl->push(array(
                'application'=>'Chaos Computer Club Trier',
                'event'=>'',
                'description'=>'The C3T room is online since '. date('H:i:s'),
                'priority'=>0,
           		),true);
}
?>