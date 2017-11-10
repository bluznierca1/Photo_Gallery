<?php require_once("../includes/initialize.php"); ?>

<?php 
	if( empty($_GET['id']) ){
		$session->message("No photo ID found.");
		redirect_to("index.php");
	}

	$photo = Photograph::find_by_id($_GET['id']);

	if(!$photo){
		$session->message("The photo could not be located");
		redirect_to("index.php");
	}

	if( isset($_POST['submit']) ){
		$author = trim($_POST['author']);
		$body = trim($_POST['body']);
		$new_comment = Comment::make($photo->id, $author, $body);

		if( $new_comment && $new_comment->save() ){
			// created new comment
			// No message needed. Seeing the comment is the proof.
			redirect_to("photo.php?id={$photo->id}");
		} else {
			// Failure
			$message = "There was an error that prevented comment from being saved.";
		}

	} else {
		$author = "";
		$body = "";
	}

	$comments = $photo->comments();

?>

<?php include("/layouts/user_header.php"); ?>

	<a href="index.php"> &laquo; Back </a>

	<div style="margin-left: 20px;">
		<img src="<?php echo $photo->image_path(); ?>" height="500px">
		<p><?php echo $photo->caption; ?></p>
	</div>

	<div id="comments">
		<?php foreach( $comments as $comment ){ ?>
			<div class="comment" style="margin-bottom: 2em;">
				<div class="author">
					<?php echo htmlentities($comment->author); ?> wrote: 
				</div>
				<div class="body">
					<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
				</div>
				<div class="meta-info" style="font-size: .8em;">
					<?php echo datetime_to_text($comment->created); ?>
				</div>
			</div>
		<?php } ?>
		<?php if( empty($comments) ) { echo "No comments so far."; } ?>
	</div>

	<!-- List comments/ -->
	
	<?php echo output_message($message); ?>
	<div id="comment-form">
		<h3>New Comment</h3>
		<?php echo output_message($message);?>

		<form action="photo.php?id=<?php echo $photo->id; ?>" method="post">
			<table>
				<tr>
					<td>Your name: </td>
					<td><input type="text" name="author" value="<?php echo $author; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><textarea name="body" cols="40" rows="8"><?php echo $body; ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Submit Comment"></td>
				</tr>
			</table>
		</form>
	</div>


<?php include("layouts/user_footer.php"); ?>


