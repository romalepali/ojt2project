<?php
 if(is_numeric($_GET['remove']) && $_GET['remove']!=0){
	$query0="SELECT * FROM printing_colors WHERE id=".$_GET['remove'];

	$result_set0=mysqli_query($conn,$query0);
	if(mysqli_num_rows($result_set0)>0){
	 $row0=mysqli_fetch_array($result_set0);
	 $remove_query = "DELETE FROM printing_colors WHERE id=".$_GET['remove'];
	 
		if(mysqli_query($conn,$remove_query)){
	 	?>
			<script type="text/javascript">
				swal({
					title: "Success?",
					text: "Color is removed!",
					type: "success",
					confirmButtonClass: "btn-primary",
					confirmButtonText: "OK",
					closeOnConfirm: false,
				},
				function(isConfirm){
				  if (isConfirm) {
				    window.location.href='<?php echo $_SESSION['page'];?>';
				  }
				});
			</script>
		<?php
		} else { ?>
			<script type="text/javascript">
				swal({
					title: "Failed?",
					text: "Color is not removed!",
					type: "error",
					confirmButtonClass: "btn-primary",
					confirmButtonText: "OK",
					closeOnConfirm: false,
				},
				function(isConfirm){
				  if (isConfirm) {
				    window.location.href='<?php echo $_SESSION['page'];?>';
				  }
				});
			</script>
		<?php
		}
	} else {?>
	 <div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
		Sorry, color does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
	 </div>
	<?php
	} 
 }else {?>
	<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 Sorry, color does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
	</div>
 <?php
 }
?>