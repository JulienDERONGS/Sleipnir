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
		
		// Setting up the database query
		$sql_host = 'mysql:dbname=' . $db_equip_helper->get_sql_db() . ';host=' . $db_equip_helper->get_sql_host(). ";charset=utf8;port=3306";
		$sql_user = $db_equip_helper->get_sql_user();
		$sql_password = $db_equip_helper->get_sql_password();
		
		try
		{
    		$sleipnir_equip_db = new PDO($sql_host, $sql_user, $sql_password);
		}
		catch (PDOException $e)
		{
		    echo 'Connection failed : ' . $e->getMessage();
		}
		
		// Query : get all equipments, their ID and type
		$sql_query = "SELECT eq.equip_id, eq.equip_name, eqt.equipType_name
		 				FROM Equipment eq, EquipmentType eqt
		 				WHERE eq.FK_equipType_id = eqt.equipType_id
		 				";
		 				
		$result = $sleipnir_equip_db->prepare($sql_query);
		$result->execute();
		$resultArray = $result->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
		$resultArray = array_map('reset', $resultArray);
		$result->closeCursor();
		
		//remove
		foreach ($resultArray as $id => $array2)
		{
			echo("ID : ". $id ."<p>");
			foreach($array2 as $key2 => $value)
			{
				echo("Value : ". $value ."<p><p><p>");
			}
		}
		unset($value);
		unset($array2);
		
		// Putting the results into a multi-dimensionnal array
		$equipmentsArray = array(array());
		
		foreach ($resultArray as $id => $array2)
		{
			foreach($array2 as $key2 => $value)
			{
				$equipmentsArray[$id][($key2)%2] = $value;
			}
		}
		unset($value);
		unset($array2);
		
		echo "<pre>";
		print_r($equipmentsArray);
		echo "</pre>";
		
		
		
		
		
		
		?>
    </body>
</html>