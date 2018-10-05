<?php
	if (isset($_POST['add_big_save'])){
		//Main Info
		$add_jo = "";
		$add_jo_val = "";
		$jon = $_POST['jon'];
		$koj = $_POST['koj'];
		$des = mysqli_real_escape_string($conn,$_POST['des']);
		$dr = $_POST['dr'];
		$agent = $_SESSION['user_id'];
		$customer = mysqli_real_escape_string($conn,$_POST['customer']);
		$pages = mysqli_real_escape_string($conn,$_POST['pages']);
		
		$add_jo .= "INSERT INTO jo (job_no,customer,job_kind,agent,description,pages";
		$add_jo_val .= "VALUES ('$jon','$customer','$koj','$agent','$des','$pages'";

		if(isset($_POST['payment']) && $_POST['payment']!=NULL){
			$payment = $_POST['payment'];
			$add_jo .= ",payment";
			$add_jo_val .= ",'$payment'";
		}

		$add_jo .= ",received_on,encoded_on)";
		$add_jo_val .= ",'$dr',NOW())";
		$add_jo_com = $add_jo." ".$add_jo_val;

		//Copies Info
		$add_copy = "";
		$add_copy_val = "";
		$copies = $_POST['copies'];

		$add_copy .= "INSERT INTO jo_copies (job_no,copies";
		$add_copy_val .= "VALUES ('$jon','$copies'";
		
		if(isset($_POST['units']) && $_POST['units']!=NULL){
			$units = $_POST['units'];
			$add_copy .= ",units";
			$add_copy_val .= ",'$units'";
		}

		$add_copy .= ",added_on,added_by)";
		$add_copy_val .= ",NOW(),'$agent')";
		$add_copy_com = $add_copy." ".$add_copy_val;

		//Execute
		if(mysqli_query($conn,$add_jo_com)){
			if($copies>0){
				if(mysqli_query($conn,$add_copy_com)){?>
					<script type="text/javascript">
						swal({
							title: "Success!",
							text: "You added a new jobbing!",
							type: "success"
						},
						function(isConfirm) {
							if (isConfirm) {
								window.location.href='<?php echo $_SESSION['page'];?>';
							}
						});
					</script><?php
				}
			}else{?>
				<script type="text/javascript">
					swal({
						title: "Success!",
						text: "You added a new jobbing!",
						type: "success"
					},
					function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}
		}
		else{?>
			<script type="text/javascript">
				swal({
					title: "Failed!",
					text: "Error adding a jobbing",
					type: "error"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script><?php
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>&add=1" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="jon" class="col-12 col-form-label">J.O. No.</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Job Order No." name="jon" id="jon" required autofocus>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="customer" class="col-12 col-form-label">Customer</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Customer" name="customer" id="customer" required>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="des" class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Description" name="des" id="des">
				</div>
			</div>
		</div>
	</div>

	<div class="row">  
		<div class="col-xl">
			<div class="form-group row">
				<label for="koj" class="col-12 col-form-label">Job Kind</label>
				<div class="col-12">
					<select class="custom-select" name="koj" id="koj" required>
						<option value="" selected disabled>Select</option><?php
						$koj_query="SELECT * FROM jo_kinds WHERE job_type=1 GROUP BY job_kind ASC";
						$koj_result=mysqli_query($conn,$koj_query);
						if(mysqli_num_rows($koj_result)>0){
							while($koj=mysqli_fetch_array($koj_result)){
								?><option value='<?php echo $koj['id'];?>'><?php echo $koj['job_kind'];?></option>"<?php
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
						<option value="" selected disabled>Select</option><?php
						$payment_query="SELECT * FROM jo_payments GROUP BY payment ASC";
						$payment_result=mysqli_query($conn,$payment_query);
						if(mysqli_num_rows($payment_result)>0){
							while($payment=mysqli_fetch_array($payment_result)){
								?><option value="<?php echo $payment['id'];?>"><?php echo $payment['payment'];?></option><?php
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
				<label for="copies" class="col-12 col-form-label">Initial Copies</label>
				<div class="col-12">
					<input class="form-control" type="number" placeholder="Enter Copies" name="copies" id="copies">
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="units" class="col-12 col-form-label">Units</label>
				<div class="col-12">
					<select class="custom-select" name="units" id="units">
						<option value="" selected disabled>Select</option><?php
						$cu_query="SELECT * FROM joc_units GROUP BY units ASC";
						$cu_result=mysqli_query($conn,$cu_query);
						if(mysqli_num_rows($cu_result)>0){
							while($cu=mysqli_fetch_array($cu_result)){
								?><option value="<?php echo $cu['id'];?>"><?php echo $cu['units'];?></option><?php
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
				<label for="pages" class="col-12 col-form-label">Pages</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Pages" name="pages" id="text">
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="dr" class="col-12 col-form-label">Received On</label>
				<div class="col-12">
					<input class="form-control" type="date" placeholder="YYYY-MM-DD" name="dr" id="dr" required>
				</div>
			</div>
		</div>
	</div>

	<div style="float: right; padding: 20px 0px">
			<a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
			<button class="btn btn-primary" type="submit" name="add_big_save">Save Jobbing</button>
	</div>
</form>