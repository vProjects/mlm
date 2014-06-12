<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	
	switch($_POST['refData']) {
		case 'country':
		{
			//taking the values from form
			$country = $_POST['country'];
			
			$country_id = $manageData->getValueWhere("country","*","name",$country);
			//getting state list
			$state_list = $manageData->getValueWhere("zone","*","country_id",$country_id[0]['country_id']);
			
			foreach($state_list as $state)
			{
				echo '<option value="'.$state['name'].'">'.$state['name'].'</option>';
			}
		}
		break;
		
		default:
		
		break;
	}	
	
?>