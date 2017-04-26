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
		
		// Query : get all equipments, their ID and their type
		$sql_query = "SELECT eq.equip_id, eq.equip_name, eqt.equipType_id, eqt.equipType_name
		 				FROM Equipment eq, EquipmentType eqt
		 				WHERE eq.FK_equipType_id = eqt.equipType_id
		 				";
		 				
		$result = $sleipnir_equip_db->prepare($sql_query);
		$result->execute();
		
		// Remplissage des données dans un tableau
		$equipments = array(array());
		
		while ($row = $result->fetch())
		{
			$id = $row['equip_id'];
			$en = $row['equip_name'];
			$tid = $row['equipType_id'];
			$et = $row['equipType_name'];
			
			$equipments[$id][0] = $id;
			$equipments[$id][1] = $en;
			$equipments[$id][2] = $tid;
			$equipments[$id][3] = $et;
		}?>
		
		<!-- Table creation -->
		<div class=table>
			<?php
			$i = 1;
			$j = 0;
			
			while (isset($equipments[$i][$j]))
			{
				// Title selection
				echo ("<ul><li class='title'>");
				switch ($j) {
				    case 0:
				        echo "ID";
				        break;
				    case 1:
				        echo "Name";
				        break;
				    case 3:
				        echo "Type";
				        break;
				    default:
				    	echo "ERROR";
				    	break;
				}
				echo ("</li>");
				while (isset($equipments[$i][$j]))
				{
					// Alternate between CSS classes
					echo ("<li class='". (($i%2==1)?"even":"odd") ."'>". $equipments[$i][$j]);
					$i++;
				}
				echo "</ul>";
				$i = 1;
				if (++$j == 2) // Avoiding the type ID
				{
					$j++;
				}
				
			}
			
			
			
			
			?>
		</div>
		
		
		
		<!--
		<div class="table">
		<ul>
			<li class="title">Name</li>
			<li class="even">Sachin</li>
			<li class="odd">Gilchrist</li>
			<li class="even">Dhoni</li>
			<li class="odd">Ponting</li>
		</ul>
		<ul>-->
		
		
		<?php
		/*
		// Query : get all equipments, their ID and their type
		$sql_query = "SELECT eq.equip_id, eq.equip_name, eqt.equipType_name
		 				FROM Equipment eq, EquipmentType eqt
		 				WHERE eq.FK_equipType_id = eqt.equipType_id
		 				";
		 				
		$result = $sleipnir_equip_db->prepare($sql_query);
		$result->execute();
		
		while ($row = $result->fetch())
		{
			$id = $row['equip_id'];
			$en = $row['equip_name'];
			$et = $row['equipType_name'];
			
			// Remplissage des données dans un tableau
			$equipments = array(array());
				$equipments[$id][0] = $id;
				//echo "<p>".$equipments[$id][0]." ";
				$equipments[$id][1] = $en;
				//echo $equipments[$id][1]." ";
				$equipments[$id][2] = $et;
				//echo $equipments[$id][2]." ";
		}
		*/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		?>
    </body>
</html>