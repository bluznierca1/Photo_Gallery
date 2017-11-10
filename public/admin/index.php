<?php require_once("../../includes/initialize.php");?>

<?php if( !$session->is_logged_in() ){ redirect_to("login.php"); }; ?>

<?php $user = $user->find_by_id($_SESSION['user_id']); ?>

<?php include("../layouts/admin_header.php"); ?>

	<h1>Hello, <?php echo $user->full_name(); ?></h1>
	
	<?php echo output_message($message); ?>
	<ul>
		<li><a href="listed_photographs.php">List photos</a></li>
		<li><a href="logfile.php?clear=false">Go to log file.</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
	

<?php include("../layouts/admin_footer.php");
