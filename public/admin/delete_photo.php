<?php require_once("../../includes/initialize.php"); ?>

<?php 
	if( !$session->is_logged_in() ) {
		redirect_to("login.php");
	}	
?>

<?php 
	if( empty($_GET['id']) ){
		$session->message("No photograph ID was provided.");
		redirect_to("index.php");
	}

	$photo = Photograph::find_by_id($_GET['id']);
	if( $photo && $photo->destroy() ){
		$session->message("Photo {$photo->filename} was deleted.");
		redirect_to("listed_photographs.php");
	} else {
		$session->message("The photo could not be removed.");
		redirect_to("index.php");
	}
?>

<?php if( isset($database)) { $database->close_connection(); } ?>
