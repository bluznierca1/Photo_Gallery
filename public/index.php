<?php require_once("../includes/initialize.php");?>
<?php 

	// 1. the current page number ($current_page);
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    // 2.records per page ( $per_page );
    $per_page = 3;
	// 3.Total record count ($total_count)
    $total_count = Photograph::count_all();

    $pagination = new Pagination($page, $per_page, $total_count);

    // just find the records for this page

    $sql = "SELECT * FROM photographs ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";
    $photos = Photograph::find_by_sql($sql);

?>

<?php include("layouts/user_header.php"); ?>


	<?php 
		foreach( $photos as $photo ){
	?>
	

		<ul class="photos" style="list-style: none;">
			<li class="photo" style="max-width: 200px; padding-left: 2em; margin-left: 1em; float: left;">
				<a href="photo.php?id=<?php echo $photo->id; ?>">
					<img src="<?php echo $photo->image_path() ; ?> " width="200px">
				</a>
				<p><?php echo $photo->caption; ?><p>
			</li>
		</ul>
	

	<?php 
		}
	?>

	<div id="pagination" style="clear: both; ">
		<?php 


			if( $pagination->total_pages() > 1){

				if( $pagination->has_previous_page() ){
					echo " <a href=\"index.php?page=";
					echo $pagination->previous_page();
					echo "\">&laquo; Previous &nbsp;&nbsp;  </a>";
				}

				for( $i=1; $i <= $pagination->total_pages(); $i++ ){
					if( $i == $page ){
						echo "<span class=\"selected\">{$i}</span>";
					} else {
						echo " <a href=\"index.php?page={$i}\"> {$i} </a> ";
					}
				}

				if( $pagination->has_next_page() ){
					echo " <a href=\"index.php?page=";
					echo $pagination->next_page();
					echo "\">Next &raquo; </a>";
				}
			}
		?>
	</div>



<?php include("layouts/admin_footer.php");