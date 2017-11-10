<?php 
	require_once("../../includes/initialize.php");

	if( $session->is_logged_in() ){
		redirect_to("index.php");
	}

	if( isset($_POST['submit']) ){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		//Check database if user exists
			$found_user = User::authenticate($username, $password);

		if( $found_user ){
			$session->login($found_user);
			log_action('Login', "{$found_user->username} logged in.");
			redirect_to("index.php");
		} else {
			// Username/Password combo was not found in the database
			$message = "Username/Password incorrect.";
		}
	}else { //Form was not submitted.
		$username = "";
		$password = "";
		$message = "Just log in.";
	}

?>

	<?php include("../layouts/admin_header.php"); ?>
			<h2>Stuff Login</h2>

			<?php echo $message; ?>

			<form action="login.php" method="post" role="form">
				<table>
					<tr>	
						<td>Username: </td>
						<td><input type="text" name="username" maxlength="30" value="<?php echo $username; ?> "></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" ></td>
					</tr>
					<tr>
					 <td colspan="2">
					 	<input type="submit" name="submit" value="Submit">
					 </td>
					</tr>
					
				</table>
			</form>

		<?php include("../layouts/admin_footer.php"); ?>

	</body>
	</html>
