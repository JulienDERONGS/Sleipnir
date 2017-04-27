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
			$_SESSION['equip_redirect'] = "direct_url";
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
		
		// Add form
		if ((isset($_POST['add'])) || (isset($_POST['new_equip_submit'])))
		{
			echo ("
			<form action='#' method='post'>
				<div class='table'>
					<ul>
						<li class='title'>Name</li>
						<li class='even'>
							<input type='input' name='new_equip_name' value=''>
						</li>
						<li class='title'>Type</li>
						<li class='odd'>
							<input type='input' name='new_equip_type' value=''>
						</li>
						<li class='even'>
							<input type='hidden' name='new_equip_process' value='added'>
							<input type='submit' name='new_equip_submit' value='Add new equipment'>
						</li>
					</ul>
				</div>
			</form>
			");
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		}
		else
		{
			// Retrieving the ID of the equipment the user wants to treat
			$id = $_POST['id'];
			
			// Query : get all equipments, their ID and their type
			$sql_query = "SELECT eq.equip_name, eqt.equipType_name
			 				FROM Equipment eq, EquipmentType eqt
			 				WHERE eqt.equipType_id = ". $id;
			 				
			$result = $sleipnir_equip_db->prepare($sql_query);
			$result->execute();
			
			// Remplissage des données dans un tableau
			$equipments = array();
			
			while ($row = $result->fetch())
			{
				$en = $row['equip_name'];
				$et = $row['equipType_name'];
				
				$equipments[0] = $en;
				$equipments[1] = $et;
			}
			
			print_r($equipments);
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