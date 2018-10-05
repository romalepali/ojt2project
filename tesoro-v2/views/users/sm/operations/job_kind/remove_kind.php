<?php
	if(is_numeric($_GET['remove']) && $_GET['remove']!=0){
		$query0="SELECT a.job_kind AS 'jk',a.job_type AS 'jtid',b.job_type AS 'jt' FROM jo_kinds a LEFT JOIN jo_type b ON a.job_type=b.id WHERE a.id=".$_GET['remove'];
		$result_set0=mysqli_query($conn,$query0);
		
		if(mysqli_num_rows($result_set0)>0){
			$row0=mysqli_fetch_array($result_set0);
			$remove_query = "DELETE FROM jo_kinds WHERE id=".$_GET['remove'];
			
			if(mysqli_query($conn,$remove_query)){?>
				<script type="text/javascript">
					swal({
						title: "Success?",
						text: "Job kind is removed!",
						type: "success",
						confirmButtonClass: "btn-primary",
						confirmButtonText: "OK",
						closeOnConfirm: false,
					},function(isConfirm){
						if(isConfirm){
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}else{?>
				<script type="text/javascript">
					swal({
						title: "Failed?",
						text: "Job kind is not removed!",
						type: "error",
						confirmButtonClass: "btn-primary",
						confirmButtonText: "OK",
						closeOnConfirm: false,
					},function(isConfirm){
						if(isConfirm){
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}
		}else{?>
			<div style="padding: 20px 10px">
				Sorry, job kind does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
	}else{?>
		<div style="padding: 20px 10px">
			Sorry, job kind does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
 	}
?>