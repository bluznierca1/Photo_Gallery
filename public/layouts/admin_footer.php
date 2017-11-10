</div>
<div id="footer">
		Copyright <?php echo date("Y", time() ); ?> Grzegorz Lasak
	</div>
	

</body>
</html>

<?php if( isset($database) ) { $database->close_connection(); } ?>