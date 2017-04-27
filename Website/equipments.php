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
        <div class="sticky_title">EQUIPMENTS LIST</div>

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
		// If coming from equipments_process.php, reset the cookie
		unset($_SESSION['equip_redirect']);
		
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
		
		// Inserting data into an array
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
		} echo "<pre>";print_r($equipments);echo "</pre>"
		?>
		
		<!-- 'Add equipment' -->
		<form action='equipments_process.php' method='post' style='padding-top: 20px !important; padding-bottom: 30px !important;'>
            <input type='submit' name='add' value='Add an equipment'>
        </form>
		
		<!-- Table creation -->
		<div class="center_wrap">
			<div class=table>
				<?php
				$i = 1;
				$j = 0;
				
				// Remember the equipments' list's last ID
				end($equipments);
				$lastID = current($equipments);
				reset($equipments);
				
				while (isset($equipments[$i][$j]))
				{
					// Title selection
					echo ("<ul><li class='title'>");
					switch ($j)
					{
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
					
					$prevID = -1;
					while ($prevID <= $lastID[0])
					{
						$prevNotSet = true;
						while (isset($equipments[$i][$j]))
						{
							// Alternate between CSS classes
							echo ("<li class='". (($i%2==1)?"even":"odd") ."'>". $equipments[$i][$j]) ."</li>";
							$i++;
							$prevID = $equipments[$i][0];
							$prevNotSet = false;
						}
						if ($prevNotSet)
						{
							$i++;
						}
					}
					
					echo "</ul>";
					$maxRows = $i-1;
					$i = 1;
					if (++$j == 2) // Avoiding the type ID
					{
						$j++;
					}
				}
				
				
				
				
				
				
				/*while (isset($equipments[$i][$j]))
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
						echo ("<li class='". (($i%2==1)?"even":"odd") ."'>". $equipments[$i][$j]) ."</li>";
						$i++;
					}
					echo "</ul>";
					$maxRows = $i-1;
					$i = 1;
					if (++$j == 2) // Avoiding the type ID
					{
						$j++;
					}
					
				}*/
				
				// Options list
				echo ("<ul><li class='title'>Options</li>");
				for($k=0; $k<$maxRows; $k++)
				{
					echo ("<li class='". (($k%2==0)?"even":"odd") ."'>".
					
					"<form action='equipments_process.php' method='post'>
						<input type='hidden' name='id' value=". $equipments[$k+1][0] .">
		                <input type='submit' name='edit' value='Edit'>
		                <input type='submit' name='delete' value='Delete'>
		            </form></li>");
				}
				echo "</ul></table>";
				?>
			</div>
		</div>
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
			
			// Inserting data into an array
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