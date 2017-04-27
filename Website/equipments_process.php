<!DOCTYPE html>
<?php if(!isset($_SESSION)){session_start();}?>

<html>
	<head>
        <meta charset="UTF-8">
        <?php require_once('/var/www/html/include/php/helper.php'); ?>
        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="include/css/sleipnir_css.css">

        <title>Sleipnir equipment managment</title>
    </head>
    
    <body class="content">

        <!-- Header : Sticky navigation bar -->
        <?php require_once('include/header/header.php'); ?>
		
        <!-- Sticky title -->
        <div class="sticky_title">EQUIPMENT MANAGMENT</div>
        
        <!-- Page's content -->
        <div class="content_centered">
		<?php

		// Redirect if not coming from the form
		if ((!isset($_POST['add'])) && (!isset($_POST['edit'])) && (!isset($_POST['delete'])) && (!isset($_POST['new_equip_submit'])))
		{
			header("location: equipments.php");
		}
		
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
		
		
		
		// New equipment request form (add part 1)
		if ((isset($_POST['add'])) || (isset($_POST['new_equip_submit'])))
		{
			// Get types values
			$sql_query = "SELECT eqt.equipType_name
			 				FROM EquipmentType eqt
			 				";
			
			$result = $sleipnir_equip_db->prepare($sql_query);
			$result->execute();
			
			// Inserting data into an array
			$types = array();
			
			while ($row = $result->fetch())
			{
				$et = $row['equipType_name'];
				$types[] = $et;
			}
			$result->closeCursor();
			
			// New equipment form
			echo ("
			<form action='#' method='post' id='new_equip'>
				<div class='table'>
					<ul>
						<li class='title'>Name</li>
						<li class='even'>
							<input type='input' name='new_equip_name' value=''>
						</li>
						<li class='title'>Type</li>
						<li class='odd'>
							<select name='new_equip_type' form='new_equip'>
								".getOptionsFromArray($types)."
							</select>
						</li>
						<li class='even'>
							<input type='submit' name='new_equip_submit' value='Add new equipment'>
						</li>
					</ul>
				</div>
			</form>
			");
			
			// New equipment request treatment (add part 2)
			if ((isset($_POST['new_equip_submit'])) && (isset($_POST['new_equip_name'])) && (isset($_POST['new_equip_type'])) )
			{
				if ($_POST['new_equip_name'] != "")
				{
					$sql_add = "INSERT INTO `Equipment` (FK_equipType_id, equip_name)
								VALUES ((
								SELECT(equipType_id)
								FROM EquipmentType
								WHERE (equipType_name LIKE '". superHtmlEntities($_POST['new_equip_type']) ."'))
		        				, '". superHtmlEntities($_POST['new_equip_name']) ."');";
		        
					// Execute the query
					$result = $sleipnir_equip_db->prepare($sql_add);
					if ($result->execute())
					{
						echo "<p><div class='success'>Equipment successfully added.<div>";
					}
					$result->closeCursor();
				}
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// Edit an equipment
		elseif(isset($_POST['edit']) || isset($_POST['edit_equip']))
		{
			// Retrieving the ID of the equipment the user wants to treat
			$id = $_POST['id'];
			
			// Get types values
			$sql_query = "SELECT eqt.equipType_name
			 				FROM EquipmentType eqt
			 				";
			
			$result = $sleipnir_equip_db->prepare($sql_query);
			$result->execute();
			$types = array();
			while ($row = $result->fetch())
			{
				$et = $row['equipType_name'];
				$types[] = $et;
			}
			$result->closeCursor();
			
			// Retreiving info to edit
			$sql_query_en = "SELECT eq.equip_name
							FROM Equipment eq
							WHERE eq.equip_id LIKE '". $id ."'";
			
			$sql_query_et = "SELECT eqt.equipType_name
							FROM Equipment eq, EquipmentType eqt
							WHERE eq.equip_id LIKE '". $id ."'";
							
			$equipToEdit = array();
			$equipToEdit[0] = $id;
			
			$result_en = $sleipnir_equip_db->query($sql_query_en);
			$row1 = $result_en->fetch();
			$equipToEdit[1] = $row1['equip_name'];
			$result_et = $sleipnir_equip_db->query($sql_query_et);
			$row2 = $result_et->fetch();
			$equipToEdit[2] = $row2['equipType_name'];
			$result_en->closeCursor();
			$result_et->closeCursor();
			
			
			print_r($equipToEdit);
			
			
			// Editable equipment form
			echo ("
			<form action='#' method='post' id='edit_equip'>
				<div class='table'>
					<ul>
						<li class='title'>ID</li>
						<li class='even'>
							<input type='input' disabled name='edit_equip_id' value='". $equipToEdit[0] ."'>
						</li>
						<li class='title'>Name</li>
						<li class='odd'>
							<input type='input' name='edit_equip_name' value='". $equipToEdit[1] ."'>
						</li>
						<li class='title'>Type</li>
						<li class='even'>
							<select name='edit_equip_type' form='edit_equip' value='". $equipToEdit[0] ."'>
								".getOptionsFromArray($types)."
							</select>
						</li>
						<li class='odd'>
							<input type='submit' name='edit_equip_submit' value='Modify this equipment'>
						</li>
					</ul>
				</div>
			</form>
			");
			
			//Editable equipment treatment
			if ((isset($_POST['edit_equip_submit'])) && (isset($_POST['edit_equip_id'])) && (isset($_POST['edit_equip_name'])) && (isset($_POST['edit_equip_type'])) )
			{
				if ($_POST['edit_equip_name'] != "")
				{
		        	$sql_edit =
		        			"UPDATE Equipment
		        				SET equip_name = '". superHtmlEntities($_POST['edit_equip_name']) ."',
		        				FK_equipType_id =
		        					(SELECT equipType_id
		        					FROM EquipmentType
		        					WHERE equipType_name = '". superHtmlEntities($_POST['edit_equip_type']) ."');
		        				
		        				";
		        
					// Execute the query
					$result = $sleipnir_equip_db->prepare($sql_edit);
					if ($result->execute())
					{
						echo "<p><div class='success'>Equipment successfully edited.<div>";
					}
					$result->closeCursor();
				}
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// delete / edit
		
		
		
		
		// Unset form's $_POST
		if (isset($_POST))
		{
			unset ($_POST);
		}
		?>
		</div>
	</body>
</html>