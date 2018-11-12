<?php
	if(isset($_FILES['file'])){
		$temp = explode(".", $_FILES["file"]["name"]);
		$target_dir = "../uploads/documents/sample/";
		$rand_name = rand(1,1000000).".".end($temp);
		$target_file = $target_dir.$rand_name;
		$uploadOk = 1;
		$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$removeExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $rand_name);

		if($FileType != "pdf") {
			echo "Sorry, only PDF files are allowed.";
			$uploadOk = 0;
		}
		else {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				$del_query="SELECT sample,job_no FROM jo_status WHERE id=".$_GET['upload_s'];
				$del_result=mysqli_query($conn,$del_query);
				if(mysqli_num_rows($del_result)>0){
					$del_file=mysqli_fetch_array($del_result);
					$file = $del_file[0];
					$file_dir = "../uploads/documents/sample/";
					
					if($file != NULL){
						unlink($file_dir.$file.".pdf");
					}

					$sql="UPDATE jo_status SET sample='$removeExt' WHERE id=".$_GET['upload_s'];
					if(mysqli_query($conn,$sql)){?>
						<script type="text/javascript">
							swal({
								title: "Success",
								text: "File has been uploaded!",
								type: "success"
							},
							function(isConfirm) {
								if (isConfirm) {
									window.location.href='<?php echo $_SESSION['page'];?>?status=<?php echo $del_file[1];?>';
								}
							});
	  					</script><?php
					}
				}
				else {?>
					<script type="text/javascript">
						swal({
							title: "Failed",
							text: "Error occurred while uploading your file!",
							type: "error"
						},
						function(isConfirm) {
							if (isConfirm) {
								window.location.href='<?php echo $_SESSION['page'];?>?status=<?php echo $del_file[1];?>';
							}
						});
	  				</script><?php
				}
			}
		}
	}
?>

<form id="form" method="POST" enctype="multipart/form-data" action="<?php echo $_SESSION['page'];?>?upload_s=<?php echo $_GET['upload_s'];?>">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="file" class="col-12 col-form-label">Upload Sample</label>
				<div class="col-12">
					<input type="file" id="file" name="file" class="form-control">
				</div>
			</div>
		</div>
	</div>
</form>