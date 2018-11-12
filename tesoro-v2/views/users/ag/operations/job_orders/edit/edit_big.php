<?php
	if(isset($_POST['edit_big_save'])){
		$des = mysqli_real_escape_string($conn,$_POST['des']);
		$customer = mysqli_real_escape_string($conn,$_POST['customer']);
		$pages = mysqli_real_escape_string($conn,$_POST['pages']);

		$small_save = "UPDATE jo SET description='$des',customer='$customer',pages='$pages'";

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
				function(isConfirm){
					if (isConfirm){
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
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>&view=<?php echo $_GET['edit']?>';
					}
				});
			</script><?php
		}
	}

	$jo_query="SELECT a.description,a.customer,a.pages,a.payment,a.received_on FROM jo a WHERE a.job_no=".$_GET['edit'];

	$jo_result=mysqli_query($conn,$jo_query);
	$jo=mysqli_fetch_array($jo_result);
?>

<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="des" class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Description" value="<?php echo $jo['description'];?>" name="des" id="des">
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="customer" class="col-12 col-form-label">Customer</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Customer" value="<?php echo $jo['customer'];?>" name="customer" id="customer" required>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="pages" class="col-12 col-form-label">Pages</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Pages" value="<?php echo $jo['pages'];?>" name="pages" id="pages">
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
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>&view=<?php echo $_GET['edit'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_big_save">Save Changes</button>
	</div>
</form>