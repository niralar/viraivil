<?php
//Login Panel Details
define('USERNAME', 'demo'); //Administrator Username
define('PASSWORD', 'demo'); //Administrator Password

//Database Details
define('HOSTNAME', 'localhost'); //Host Name
define('DBUSERNAME', 'admin_viraivil'); //Database Username
define('DBPASSWORD', '434Q2vBVyf'); //Database Password
define('DATABASE', 'admin_viraivil'); //Database Name
define('TABLE', 'subscribe'); //Table Name

//Pagination Configuration
define('RECORDPERPAGE', '10'); //Number of Rows/Items Per Page
define('SHOWPAGENUMBERS', 'true'); //Hide/Show Page Numbers Button
define('SHOWPREVNEXT', 'true'); //Hide/Show Previous & Next Button

//Receiver Mail i.e., From Email Address
define('SUBSCRIBER_FROM_NAME', 'Subscriber');
define('TO_EMAIL', 'support@niralar.com');

//Subject For Email
define('SUBJECT', 'Contact from your website');
define('USERSUBJECT', 'Welcome to Viraivil');

//Subscription
define('SUBSCRIPTION', 'Yes');


//Messages
define('SUBSCRIBER_MAIL_MESSAGE', 'New subscriber subscribed to our website');
define('USER_SUBSCRIBER_MAIL_MESSAGE', 'Subscribed Successfully, To unsubscribe http://demo.niralar.com/viraivil/unsubscribe/');
define('MSG_INVALID_NAME', 'Please enter your name.');
define('MSG_INVALID_EMAIL', 'Please enter valid e-mail.');
define('MSG_INVALID_MESSAGE', 'Please enter your message.');
define('MSG_SEND_ERROR', 'Sorry, we can\'t send this message.');
define('MSG_INVALID_SUBSCRIBE_EMAIL', 'Oops! Please enter a valid email address');

//Connecting to Database
$con = mysqli_connect(HOSTNAME, DBUSERNAME, DBPASSWORD, DATABASE);
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>