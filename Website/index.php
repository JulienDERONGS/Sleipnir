<!DOCTYPE html>
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
        <?php echo "pouet"; ?>
        <!-- Include the helper -->
        <?php
        use HelperClasses;
        ?>

        <!-- Sticky title -->
        <div class="sticky_title">HOME</div>

        <!-- Page's content -->
        <div class="content_centered">
            Welcome to the Sleipnir's equipments' managment page
        </div>

        <div><?php
            //$helper = new HelperClasses\Database();
            //$helper->set_sql_host("test");
            //echo $helper->get_sql_host();
            
            echo HelperClasses/$var111;
        ?></div>
        <div>
        	<?php echo phpinfo(); ?>
        </div>
    </body>
</html>