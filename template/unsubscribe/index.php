<?php
require_once('../php/config.php');

//$_GET["email"];
$err     = "";
$pattern = "^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$^";
if (isset($_GET['email'])) {


if (!preg_match_all($pattern, $_GET['email'], $out)) {
    $err = MSG_INVALID_SUBSCRIBE_EMAIL;
}
if (!$_GET['email']) {
    $err = MSG_INVALID_SUBSCRIBE_EMAIL;
}


if (!$err) {
    $query  = "SELECT * FROM `" . TABLE . "` WHERE email_address = '" .mysql_reaL_escape_string($_GET['email']). "'";
    $check = mysql_query($query);
    if (mysql_num_rows($check) > 0)
	{
	    $sql    = "UPDATE `" . TABLE . "` SET subscribed='No' WHERE email_address='".mysql_reaL_escape_string($_GET['email'])."'";
        $result = mysql_query($sql);
		}
    else {
 $err= "You are Unsubscribed already";
		}
    }
 else {
    echo $err;
}

	    }	
	?>
<!DOCTYPE html>
<html>
  <head>
    <title>Viraivil | Coming Soon</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Cascading Style Sheets -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/custom.css" />
    <!--[if IE 7]>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
    <!-- /Cascading Style Sheets -->
  </head>
  <body>
  <!-- Main Content -->
  <div class="content">
      <div class="loginpanel">
      <div class="logo">
        <img src="../images/logo.png" alt="Viraivil" class="img-rounded" />
      </div>
	  <?php if (isset($result)) { ?>
	  <div class="unsubscribesucess">
	<p>You are Unsubscribed Successfully !!</p>
	</div> 
	  <?php } else { ?> 
    <div class="unsubscribe">
      <p>Please provide your email address if you do not wish to receive email notification us !!</p>
      <form class="form-inline" id="unsubscribe" action="">
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php if (isset($_GET['email'])) { echo $_GET["email"]; } ?>" placeholder="type your email address" />
      <input type="submit" class="btn btn-primary" value="Unsubscribe" /></form>
    </div>
	<p><?php echo $err ?></p>
	
	
	<?php } ?>
    </div>

  </div>
  <!-- /Main Content -->
  <!-- JavaScript-->
  <script src="../js/jquery-1.10.2.min.js"></script> 
  <script src="../js/bootstrap.min.js"></script> 
  <script src="../js/jquery.countdown.js" type="text/javascript" charset="utf-8"></script> 
  <script type="text/javascript" src="../js/bootstrap-progressbar.min.js"></script> 
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script> 
  <script type="text/javascript" src="../js/admin.js"></script> 
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->  
  <!-- /JavaScript--></body>
</html>