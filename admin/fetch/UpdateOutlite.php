<?php 
	require_once("../../classes/adminClass.php");
	require_once("../../classes/outliteClass.php");
	
	session_start();
	if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])){
		header('Location: ./login.php');	
	}
	$admin = new admin($_SESSION['admin_id']);
	
	
	function test_input($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['OutliteAddressLatitude']) && isset($_POST['OutliteAddresslongitude'])){
		
		$id =  test_input($_POST['id']);
		$name =  test_input($_POST['name']);
		$address = test_input($_POST['address']);
		$latitude = test_input($_POST['OutliteAddressLatitude']);
		$longitude = test_input($_POST['OutliteAddresslongitude']);
		
		$out = array();
		if(isset($admin->outlite)){
			foreach($admin->outlite as $outlite){
				$out[] = $outlite->id;
			}
		}
		
		$Error="";
							
		if(!in_array($id, $out)){
			 $Error = "Invalid Outlite";						
		}elseif(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$name)) {
		  $Error = "Only letters, numbers and white space allowed for Outlite Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Outlite Name";
		}elseif(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$address)) {
		  $Error = "Only letters, numbers and white space allowed for address Name";
		}elseif(" " == $address) {
		  $Error = "Please Add Outlite Address";
		}elseif(!preg_match("/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/",$latitude)) {
		  $Error = "Invalid Latitude Formate";
		}elseif(!preg_match("/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/",$longitude)) {
		  $Error = "Invalid Longitude Formate";
		}else{
			
			$outlite = new outlite($id);
			$outlite_result = $outlite->updateOutlite($name,$address,$latitude, $longitude);
			if($outlite_result == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Outlite Updated Successfully
				  </div>";
			}else{
				$Error = "Try Again with other Infomation";
			}
			
		}
		
		
		if($Error != ""){
				echo "<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-ban'></i> Error!</h4>
						".$Error."
				  </div>";
		}
		
	}
	
?>