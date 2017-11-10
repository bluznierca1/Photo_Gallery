<?php 
require_once("../../includes/initialize.php");

if( !$session->is_logged_in() ) {
	redirect_to("login.php");
}
?>
<?php	
	
	$logfile = "log.txt";

	if( $_GET["clear"] == 'true'){
		file_put_contents($logfile, '');
		// Add the first  log entry
		log_action('Logs Cleared', "By User ID {$session->user_id}");
		// redirect to this same page so that URL will not have clear == true anymore
		redirect_to('logfile.php');
	}
?>		

<?php include("../layouts/admin_header.php"); ?>
<a href="index.php">&laquo; Back </a>

<br />

<h2> Log File </h2>

<p><a href="logfile.php">Clear Log File</a></p>

<?php 

	if( file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r') ){
		// read
		echo "<ul class=\"log-entries\" >";
		while(!feof($handle) ){
			$entry = fgets($handle);
			if(trim($entry) != "" ){
				echo "<li>{$entry}</li>";
			}
		}
		echo "</ul>";
		fclose($handle);
	} else {
		echo "Could not read from {$logfile}.";
	}
?>

