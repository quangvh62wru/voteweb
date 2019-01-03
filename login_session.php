<?php
// if the login form was submitted
if($_POST){
    // include classes
	include_once "config/database.php";
	include_once "objects/user.php";
	
// get database connection
	$database = new Database();
	$db = $database->getConnection();
	
// initialize objects
	$user = new User($db);
	
// check if email and password are in the database
	$user->email=$_POST['email'];
	
// check if email exists, also get user details using this emailExists() method
	$email_exists = $user->emailExists();
	
// validate login
	if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){
		
    // if it is, set the session value to true
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $user->id;
		$_SESSION['access_level'] = $user->access_level;
		$_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8') ;
		$_SESSION['lastname'] = $user->lastname;
		
    // if access level is 'Admin', redirect to admin section
		if($user->access_level=='Admin'){
			header("Location: {$home_url}admin/index.php?action=login_success");
		}
		
    // else, redirect only to 'Customer' section
		else{
			header("Location: {$home_url}index.php?action=login_success");
		}
	}
	
// if username does not exist or password is wrong
	else{
		$access_denied=true;
	}
}

?>