<?php
	if(is_numeric($_GET['remove']) && $_GET['remove']!=0){
		$query0="SELECT * FROM jos_list WHERE id=".$_GET['remove'];
		$result_set0=mysqli_query($conn,$query0);

		if(mysqli_num_rows($result_set0)>0){
			$row0=mysqli_fetch_array($result_set0);
			$remove_query = "DELETE FROM jos_list WHERE id=".$_GET['remove'];
	 
			if(mysqli_query($conn,$remove_query)){?>
				<script type="text/javascript">
					swal({
						title: "Success?",
						text: "Status is removed!",
						type: "success",
						confirmButtonClass: "btn-primary",
						confirmButtonText: "OK",
						closeOnConfirm: false,
					},function(isConfirm){
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			} else { ?>
				<script type="text/javascript">
					swal({
						title: "Failed?",
						text: "Status is not removed!",
						type: "error",
						confirmButtonClass: "btn-primary",
						confirmButtonText: "OK",
						closeOnConfirm: false,
					},function(isConfirm){
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}
		} else {?>
			<div style="padding: 20px 10px">
				Sorry, status does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
	}else {?>
		<div style="padding: 20px 10px">
			Sorry, status does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>