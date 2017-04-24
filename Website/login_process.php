<?php session_start(); ?>
<html>
<?php
require_once('/var/www/html/include/php/helper.php');


// Redirect if not coming from the login form
if (!isset($_POST['submitted']))
{
	$_SESSION['login_redirect'] = "direct_url";
	header("location: login.php");
}

// Redirect in case of invalid e-mail formating
elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == FALSE)
{
	$_SESSION['login_redirect'] = "email_or_password";
	header("location: login.php");
}

// Store login infos
$email = $_POST['email'];
$password = hash("sha256", $_POST['password']);

// Database helper, linked to the database configuration file
$db_helper = new S_Database("user");

$sql_host = 'mysql:dbname=' . $db_helper->get_sql_db() . ';host=' . $db_helper->get_sql_host();
$sql_user = $db_helper->get_sql_user();
$sql_password = $db_helper->get_sql_password();

try
{
    $sleipnir_user_db = new PDO($sql_host, $sql_user, $sql_password);
}
catch (PDOException $e)
{
    echo 'Connection failed : ' . $e->getMessage();
}

$sql_query = "SELECT *
 				FROM " . $db_helper->get_sql_table() . "
 				WHERE user_email = '". $email ."'
 				AND user_password = '" . $password ."'";
 				
$result = $sleipnir_user_db->query($sql_query);
$userExists=$result->rowCount();
if ($userExists == 1)
{
	//User Class go
	echo "Success :)";
}

//$_SESSION['sessionid'] = session_id();



?>
</html>