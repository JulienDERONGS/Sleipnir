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

        <!-- Sticky title -->
        <div class="sticky_title">HOME</div>

        <!-- Page's content -->
        <div class="content_centered">
            Welcome to the Sleipnir's equipments' managment page
        </div>

        <div>
        <?php
            $newDB = new S_Database();
            $hp = new S_Helper();
            $usr = new S_User("a@a.a", "psw", "0");
        ?>
        </div>
    </body>
</html>