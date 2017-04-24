<html><?php
require_once('/var/www/html/include/php/helper.php');

$htmlRedir = "
	<div>
		<meta http-equiv=\"Refresh\" content=\"0;url=login.php\"> 
	</div>";

// Redirect if not coming from the login form
if (!isset($_POST['log_send']))
{
	$_SESSION['login_redirect'] = "direct_url";
	echo $htmlRedir;
}

// Redirect in case of invalid e-mail formating
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == FALSE)
{
	$_SESSION['login_redirect'] = "email_or_password";
	echo $htmlRedir;
}

// Store login infos
$email = $_POST['email'];
$password = hash("sha256", $_POST['password']);

// SQL treatment







?></html>