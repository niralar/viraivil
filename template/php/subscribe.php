<?php
require_once('config.php');
$email   = trim($_POST['email']);
$err     = "";
$headers = "From: " . SUBSCRIBER_FROM_NAME . " <" . $email . ">\r\nReply-To: " . $email . "";
$userheaders = "From: Viraivil <" . TO_EMAIL . ">\r\nReply-To: " . TO_EMAIL . "";
$pattern = "^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$^";
if (!preg_match_all($pattern, $email, $out)) {
    $err = MSG_INVALID_SUBSCRIBE_EMAIL;
}
if (!$email) {
    $err = MSG_INVALID_SUBSCRIBE_EMAIL;
}
if (!$err) {
    //Save to Database
    $query  = "SELECT * FROM `" . TABLE . "` WHERE email_address = '" . mysql_real_escape_string($email) . "'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) > 0)
        echo "Already exists in the subscriber database!";
    else {
        $query = "INSERT INTO `" . TABLE . "` ( `email_address`, `subscribed`) VALUES ( '" . mysql_real_escape_string($email) . "', '" . SUBSCRIPTION . "')";
        mysql_query($query) or die("Error adding " . $email . " to the database!");
        $sent = mail(TO_EMAIL, SUBJECT, SUBSCRIBER_MAIL_MESSAGE, $headers);
		$usersent = mail($email, USERSUBJECT, USER_SUBSCRIBER_MAIL_MESSAGE, $userheaders);
        if ($sent)
            echo "Subscribed Successfully";
        else
            echo MSG_SEND_ERROR;
    }
} else {
    echo $err;
}
?>