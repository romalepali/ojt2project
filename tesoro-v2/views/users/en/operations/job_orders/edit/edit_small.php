<?php
	if (isset($_POST['edit_small_save'])) {
		$des = mysqli_real_escape_string($conn,$_POST['des']);
		$customer = mysqli_real_escape_string($conn,$_POST['customer']);
		$pages = mysqli_real_escape_string($conn,$_POST['pages']);

		$small_save = "UPDATE jo SET description='$des',customer='$customer',pages='$pages'";

		if(isset($_POST['color']) && $_POST['color']!=NULL){
			$color = $_POST['color'];
			$small_save .= ",color='$color'";
		}else{
			$small_save .= ",color=NULL";
		}

		if(isset($_POST['materials']) && $_POST['materials']!=NULL){
			$materials = $_POST['materials'];
			$small_save .= ",materials='$materials'";
		}else{
			$small_save .= ",materials=NULL";
		}

		if(isset($_POST['size']) && $_POST['size']!=NULL){
			$size = $_POST['size'];
			$small_save .= ",size='$size'";
		}else{
			$small_save .= ",size=NULL";
		}

		if(isset($_POST['printing']) && $_POST['printing']!=NULL){
			$printing = $_POST['printing'];
			$small_save .= ",printing='$printing'";
		}else{
			$small_save .= ",printing=NULL";
		}

		if(isset($_POST['payment']) && $_POST['payment']!=NULL){
			$payment = $_POST['payment'];
			$small_save .= ",payment='$payment'";
		}else{
			$small_save .= ",payment=NULL";
		}

		$small_save .= " WHERE job_no=".$_GET['edit'];

		if(mysqli_query($conn,$small_save)){?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "Your changes are applied!",
					type: "success"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>&view=<?php echo $_GET['edit']?>';
					}
				});
			</script><?php
		}else{?>
			<script type="text/javascript">
				swal({
					title: "Failed",
					text: "No changes applied!",
					type: "error"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>&view=<?php echo $_GET['edit']?>';
					}
				});
			</script><?php
		}
	}

	$jo_query="SELECT a.description,a.customer,a.pages,a.color,a.materials,a.size,a.printing,a.payment,a.received_on FROM jo a WHERE a.job_no=".$_GET['edit'];

	$jo_result=mysqli_query($conn,$jo_query);
	$jo=mysqli_fetch_array($jo_result);
?>

<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="customer" class="col-12 col-form-label">Customer</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Customer" name="customer" value="<?php echo $jo['customer'];?>" id="customer" required>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="des" class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Description" value="<?php echo $jo['description'];?>" name="des" id="des">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="pages" class="col-12 col-form-label">Pages</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Pages" name="pages" value="<?php echo $jo['pages'];?>" id="text">
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="color" class="col-12 col-form-label">Color</label>
				<div class="col-12">
					<select class="custom-select" name="color" id="color">
						<option value="" selected>None</option><?php
						$color_query="SELECT * FROM jo_colors GROUP BY color";
						$color_result=mysqli_query($conn,$color_query);
						if(mysqli_num_rows($color_result)>0){
							while($color=mysqli_fetch_array($color_result)){
								if($color['id']==$jo['color']){
									?><option value='<?php echo $color['id'];?>' selected><?php echo $color['color'];?></option><?php
								}
								else{
									?><option value='<?php echo $color['id'];?>'><?php echo $color['color'];?></option><?php
								}
							}
						}
						else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="materials" class="col-12 col-form-label">Materials</label>
				<div class="col-12">
					<select class="custom-select" name="materials" id="materials">
						<option value="" selected>None</option><?php
						$materials_query="SELECT * FROM jo_materials GROUP BY materials";
						$materials_result=mysqli_query($conn,$materials_query);
						if(mysqli_num_rows($materials_result)>0){
							while($materials=mysqli_fetch_array($materials_result)){
								if($materials['id']==$jo['materials']){
									?><option value='<?php echo $materials['id'];?>' selected><?php echo $materials['materials'];?></option><?php
								}
								else{
									?><option value='<?php echo $materials['id'];?>'><?php echo $materials['materials'];?></option><?php
								}
							}
						}
						else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="size" class="col-12 col-form-label">Size</label>
				<div class="col-12">
					<select class="custom-select" name="size" id="size">
						<option value="" selected>None</option><?php
						$size_query="SELECT * FROM jo_size GROUP BY size";
						$size_result=mysqli_query($conn,$size_query);
						if(mysqli_num_rows($size_result)>0){
							while($size=mysqli_fetch_array($size_result)){
								if($size['id']==$jo['size']){
									?><option value='<?php echo $size['id'];?>' selected><?php echo $size['size'];?></option><?php
								}
								else{
									?><option value='<?php echo $size['id'];?>'><?php echo $size['size'];?></option><?php
								}
							}
						}
						else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="printing" class="col-12 col-form-label">Printing</label>
				<div class="col-12">
					<select class="custom-select" name="printing" id="printing">
						<option value="" selected>None</option><?php
						$printing_query="SELECT * FROM jo_printing GROUP BY printing";
						$printing_result=mysqli_query($conn,$printing_query);
						if(mysqli_num_rows($printing_result)>0){
							while($printing=mysqli_fetch_array($printing_result)){
								if($printing['id']==$jo['printing']){
									?><option value='<?php echo $printing['id'];?>' selected><?php echo $printing['printing'];?></option><?php
								}
								else{
									?><option value='<?php echo $printing['id'];?>'><?php echo $printing['printing'];?></option><?php
								}
							}
						}
						else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="payment" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<select class="custom-select" name="payment" id="payment">
						<option value="" selected>None</option><?php
						$payment_query="SELECT * FROM jo_payments GROUP BY payment";
						$payment_result=mysqli_query($conn,$payment_query);
						if(mysqli_num_rows($payment_result)>0){
							while($payment=mysqli_fetch_array($payment_result)){
								if($payment['id']==$jo['payment']){
									?><option value='<?php echo $payment['id'];?>' selected><?php echo $payment['payment'];?></option><?php
								}
								else{
									?><option value='<?php echo $payment['id'];?>'><?php echo $payment['payment'];?></option><?php
								}
							}
						}
						else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
			<a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>&view=<?php echo $_GET['edit'];?>">Cancel</a>
			<button class="btn btn-primary" type="submit" name="edit_small_save">Save Changes</button>
		</div>
</form>