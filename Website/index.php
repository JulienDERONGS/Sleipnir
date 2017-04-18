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
        
        <!-- Include the helper -->
        <?php use HelperNamespace; ?>

        <!-- Sticky title -->
        <div class="sticky_title">HOME</div>

        <!-- Page's content -->
        <div class="content_centered">
            Welcome to the Sleipnir's equipments' managment page
        </div>




        <div><?php
            $helper = new HelperNamespace\Helper();
            
            $helper->setSQLHost("testHELPER OK !");
            echo $helper->getSQLHost();
            
            
        ?></div>

        </script>
    </body>
</html>