<?php require_once("../../includes/initialize.php"); ?>

<?php 
	if( $_SESSION['user_id']){
		$session->logout($_SESSION['user_id']);
		redirect_to("login.php");
	} else {
		echo "Users are logout.";
	}
?>