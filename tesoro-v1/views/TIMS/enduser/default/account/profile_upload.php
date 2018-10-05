<?php
if(isset($_POST['reset'])){
	$default = 'default';
	$reset_query="SELECT picture FROM users WHERE id=".$_SESSION['TIMS_id'];
	$reset_result=mysqli_query($conn,$reset_query);
	if(mysqli_num_rows($reset_result)>0){
		$del_pic=mysqli_fetch_array($reset_result);
		$pic = $del_pic[0];
		if($pic != "default"){
			$pic_dir = "../../users/images/";
			unlink($pic_dir.$pic.".png");
		}
	}
	$sql="UPDATE users SET picture='$default' WHERE id=".$_SESSION['TIMS_id'];
	if(mysqli_query($conn,$sql)){
	?>
		<script type="text/javascript">
			window.location.href='<?php echo $_SESSION['page'];?>';
		</script>
	<?php
	}
}

if(isset($_FILES['file'])){
	$temp = explode(".", $_FILES["file"]["name"]);
	$target_dir = "../../users/images/";
	$rand_name = rand(1,1000000).".".end($temp);
	$target_file = $target_dir.$rand_name;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$removeExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $rand_name);

	if($imageFileType != "png") {
		echo "Sorry, only PNG files are allowed.";
		$uploadOk = 0;
	}
	else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			$del_query="SELECT picture FROM users WHERE id=".$_SESSION['TIMS_id'];
			$del_result=mysqli_query($conn,$del_query);
			if(mysqli_num_rows($del_result)>0){
				$del_pic=mysqli_fetch_array($del_result);
				$pic = $del_pic[0];
				if($pic != "default"){
					$pic_dir = "../../users/images/";
						unlink($pic_dir.$pic.".png");
					}
				}

				$sql="UPDATE users SET picture='$removeExt' WHERE id=".$_SESSION['TIMS_id'];
				if(mysqli_query($conn,$sql)){
				?>
				<script type="text/javascript">
					window.location.href='<?php echo $_SESSION['page'];?>';
	  			</script>
				<?php
				}
				echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
			}
			else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>

<form id="form" method="POST" enctype="multipart/form-data" action="<?php echo $_SESSION['page'];?>">
	<label class="custom-file">
		<input type="file" id="file" name="file" class="custom-file-input">
		<span class="custom-file-control form-control">Choose file</span>
	</label>
</form><br>
<form class="mb-4" id="form" method="POST" enctype="multipart/form-data" action="<?php echo $_SESSION['page'];?>">
	<button type="submit" name="reset" class="form-control">Reset</button>
</form>