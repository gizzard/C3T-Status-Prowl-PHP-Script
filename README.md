ABOUT
------------
The C3T-Status-Prowl-PHP-Script is a little PHP script which will continuously check the state of the CCC Trier e. V. clubroom LED. If the room is online you will get a notification via prowl.
  
  
LICENCE
------------
For roundabout 60 lines of PHP code? You're kidding, right?
   
     
REQUIREMENTS
------------

Server: A PHP runtime of course, and the ProwlPHP.php [from Github](http://github.com/Fenric/ProwlPHP).

Client: Prowl App for iOS and a Prowl Account with API key. More information on Prowl can be found at [http://prowl.weks.net](http://prowl.weks.net/).


HOW TO
------------
Drop the c3tstatus.php and the prowlPHP.php together in a directory. Edit the c3tstatus.php and insert your API key. Run with: php -f c3tstatus.php.

If you just want to push a message to your prowl device you can use the pushMessage.php with a string argument. 
php -f pushMessage.php whatever you want to say


WHY
------------
Good question. I don't know. Be warned, PHP doesn't seem to be the ideal runtime for this job and the code isn't fault tolerant or tested for every circumstance of life.