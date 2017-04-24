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
        <div class="sticky_title">EQUIPMENTS' MANAGMENT</div>

        <!-- Equipments' table' -->
        <!--<div class="table">
			<ul>
				<li class="title">Name</li>
				<li class="even">Sachin</li>
				<li class="odd">Gilchrist</li>
				<li class="even">Dhoni</li>
				<li class="odd">Ponting</li>
			</ul>
			<ul>
				<li class="title">Country</li>
				<li class="even">India</li>
				<li class="odd">Australia</li>
				<li class="even">India</li>
				<li class="odd">Australia</li>
			</ul>
			<ul>
				<li class="title">Ranking</li>
				<li class="even">1</li>
				<li class="odd">2</li>
				<li class="even">6</li>
				<li class="odd">10</li>
			</ul>
		</div>-->
		
		<?php
		// Equiments database helper, linked to the database configuration file
		$db_equip_helper = new S_Database("equip");
		
		$sql_host = 'mysql:dbname=' . $db_equip_helper->get_sql_db() . ';host=' . $db_equip_helper->get_sql_host();
		$sql_user = $db_equip_helper->get_sql_user();
		$sql_password = $db_equip_helper->get_sql_password();
		
		try
		{
    		$sleipnir_user_db = new PDO($sql_host, $sql_user, $sql_password);
		}
		catch (PDOException $e)
		{
		    echo 'Connection failed : ' . $e->getMessage();
		}

		$sql_query = "SELECT *
		 				FROM " . $db_equip_helper->get_sql_table();
		 				
		$results = $sleipnir_user_db->prepare($sql_query);
		$results->execute();
		$resultArray = $results->fetchAll(PDO::FETCH_COLUMN, 1);
		$results->closeCursor();
		
		echo "<pre>";
		print_r($resultArray);
		echo "</pre>";
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		?>
    </body>
</html>