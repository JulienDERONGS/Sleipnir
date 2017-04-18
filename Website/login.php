<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php require_once('/var/www/html/include/php/helper.php'); ?>
        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="include/css/sleipnir_css.css">

        <title>Sleipnir equipments</title>
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
                <input type="text" name ="email">
                <br>
                <br>
                Enter your password :
                <br>
                <input type="text" name ="password">
                <br>
                <br>
                <input type="submit" name="log_send" value="Log in">
            </form>
        </div>

        </script>
    </body>
</html>