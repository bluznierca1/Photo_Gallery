<?php require_once("../../includes/initialize.php");?>

<?php if( !$session->is_logged_in() ){ redirect_to("login.php"); }; ?>

<?php $user = $user->find_by_id($_SESSION['user_id']); ?>

<?php include("../layouts/admin_header.php"); ?>

	<?php 

	//CREATING
	// $user = new User();
	// $user->username = "johnsmith";
	// $user->password = "gallery";
	// $user->first_name = "john";
	// $user->last_name = "smith";
	// $user->save();


	//UPDATING
	// $user = User::find_by_id(4);
	// $user->password = "siema";
	// $user->save();

	// $user = User::find_by_id(3);
	// $user->delete();

?>


<?php include("../layouts/admin_footer.php");