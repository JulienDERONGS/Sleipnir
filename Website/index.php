<!DOCTYPE html>
<?php if(!isset($_SESSION)){session_start();}?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="include/css/sleipnir_css.css">
        <?php require_once('include/php/helper.php'); ?>
        <title>Sleipnir equipments</title>
    </head>

    <body class="content">
        <!-- Header : Sticky navigation bar -->
        <?php require_once('include/header/header.php'); ?>

        <!-- Sticky title -->
        <div class="sticky_title">HOME</div>

        <!-- Page's content -->
        <div class="content_centered">
            Welcome to Sleipnir's equipments' managment site, please log in to consult or manage equipments
        </div>
        
        <?php
        // Display a message if the user just logged in
        if (isset($_SESSION['logged_in']))
        {
			if ($_SESSION['logged_in'] == true)
        	{
				echo "
					<div class=\"logged_in_out\">
						<br>
		        		Successfully logged in.
		        	</div>
				";
				$_SESSION['logged_in'] = "";
			}
		}
        
        // Display a message if the user just logged out
        if (isset($_SESSION['logged_out']))
        {
			if ($_SESSION['logged_out'] == true)
        	{
				echo "
					<div class=\"logged_in_out\">
						<br>
		        		Successfully logged out.
		        	</div>
				";
				$_SESSION['logged_out'] = "";
			}
		}
		
        ?>
    </body>
</html>
















