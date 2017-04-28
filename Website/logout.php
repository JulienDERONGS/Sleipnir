<!DOCTYPE html>
<?php if(!isset($_SESSION)){session_start();}


if (isset($_SESSION))
{
	session_unset();
	session_destroy();
}

// Launch a clean session and send the user to the index with a successful logout message
if(!isset($_SESSION)){session_start();}
$_SESSION['logged_out'] = true;
header('location: /include/misc/redir.php');
?>