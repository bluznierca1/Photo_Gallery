<?php require_once("../../includes/initialize.php") ?>	

<?php if( !$session->is_logged_in() ){ redirect_to("login.php"); }	?>

<?php 
	if( empty($_GET['id']) ){
		$session->message("No photo ID was provided.");
		redirect_to("index.php");
	} 

	$photo = Photograph::find_by_id($_GET['id']);
	if(!$photo){
		$session->message("The photo could not be located.");
		redirect_to("index.php");
	}

	$comments = $photo->comments();
?>

<?php include("../layouts/admin_header.php"); ?>
	
	
<a href="listed_photographs.php">&laquo; Back </a>
<br />

<h2>Comment on: <?php echo $photo->filename; ?> </h2>

<?php echo output_message($message); ?>
<div id="comments">
	<?php foreach( $comments as $comment) {
	?>	
			
		<div class="comment" style="margin-bottom: 2em;">
			<div class="author">
				<?php echo htmlentities($comment->author); ?> wrote:
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
			<div class="meta-info" style="font-size: .8em;">
				<?php echo datetime_to_text($comment->created); ?>
			</div>
			<div class="actions" style="font-size: .8em;">
				<a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete Comment </a>
			</div>
		</div>
	<?php } ?>
	<?php if( empty($comments) ){ echo "No comments so far."; } ?>
</div>


<?php include("../layouts/admin_footer.php"); ?>
