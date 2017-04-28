<!DOCTYPE html>
<?php if(!isset($_SESSION)){session_start();}?>

<html>
    <head>
        <meta charset="UTF-8">
        <?php require_once('/var/www/html/include/php/helper.php'); ?>
        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="include/css/sleipnir_css.css">

        <title>Sleipnir login page</title>
    </head>
    
    <body class="content">

        <!-- Header : Sticky navigation bar -->
        <?php require_once('include/header/header.php'); ?>
		
        <!-- Sticky title -->
        <div class="sticky_title">LOG IN</div>
        
        <!-- Page's content -->
        <div class="content_centered">

            <!-- Login form -->
            <form action="login_process.php" method="post">
                Enter your e-mail :
                <br>
                <input type="text" name="email">
                <br>
                <br>
                Enter your password :
                <br>
                <input type="password" name="password">
                <br>
                <br>
                <input type="submit" name="submitted" value="Log in">
            </form>
        </div>
        <div>
        	<?php
        	// If already logged in, redirect to the index page
        	if ((isset($_SESSION['email'])) && (isset($_SESSION['password'])))
        	{
				header("location: index.php");
			}
        	
        	// Login errors --> info message & session cleaning
    		if (isset($_SESSION['login_redirect']))
    		{
    			// If tried to go directly on login_process.php without logging in first
				if ($_SESSION['login_redirect'] == "direct_url")
				{ echo "
					<div class='error'>
						<br>
						Please log in from the above form.
					</div>
					";
				}
				elseif ($_SESSION['login_redirect'] == "wrong_email_password")
				{ echo "
					<div class='login_error'>
						<br>
						Wrong e-mail and/or password.
					</div>
					";
				}
				$_SESSION['login_redirect'] = "";
			}
        	?>
        </div>
    </body>
</html>