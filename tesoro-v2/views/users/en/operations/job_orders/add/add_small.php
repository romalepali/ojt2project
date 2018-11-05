<?php
	if (isset($_POST['add_small_save'])){
		//Main Info
		$encoder = $_SESSION['user_id'];
		$add_jo = "";
		$add_jo_val = "";
		
		$jon = $_POST['jon'];
		$koj = $_POST['koj'];
		$des = mysqli_real_escape_string($conn,$_POST['des']);
		$dr = $_POST['dr'];
		$encoded_by = $_SESSION['user_id'];
		$customer = mysqli_real_escape_string($conn,$_POST['customer']);
		$pages = mysqli_real_escape_string($conn,$_POST['pages']);

		$add_jo .= "INSERT INTO jo (job_no,customer,job_kind,description,pages";
		$add_jo_val .= "VALUES ('$jon','$customer','$koj','$des','$pages'";
		
		if(isset($_POST['ag']) && $_POST['ag']!=NULL){
			$agent = $_POST['ag'];
			$add_jo .= ",agent";
			$add_jo_val .= ",'$agent'";
		}
		
		if(isset($_POST['ar']) && $_POST['ar']!=NULL){
			$artist = $_POST['ar'];
			$add_jo .= ",artist";
			$add_jo_val .= ",'$artist'";
		}

		if(isset($_POST['size']) && $_POST['size']!=NULL){
			$size = $_POST['size'];
			$add_jo .= ",size";
			$add_jo_val .= ",'$size'";
		}

		if(isset($_POST['color']) && $_POST['color']!=NULL){
			$color = $_POST['color'];
			$add_jo .= ",color";
			$add_jo_val .= ",'$color'";
		}

		if(isset($_POST['materials']) && $_POST['materials']!=NULL){
			$materials = $_POST['materials'];
			$add_jo .= ",materials";
			$add_jo_val .= ",'$materials'";
		}

		if(isset($_POST['printing']) && $_POST['printing']!=NULL){
			$printing = $_POST['printing'];
			$add_jo .= ",printing";
			$add_jo_val .= ",'$printing'";
		}

		if(isset($_POST['payment']) && $_POST['payment']!=NULL){
			$payment = $_POST['payment'];
			$add_jo .= ",payment";
			$add_jo_val .= ",'$payment'";
		}

		$add_jo .= ",received_on,encoded_by,encoded_on)";
		$add_jo_val .= ",'$dr','$encoded_by',NOW())";
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
		
		//Status Info
		$add_status = "";
		$add_status_val = "";
		$notes = $_POST['notes'];

		$add_status .= "INSERT INTO jo_status (job_no,notes";
		$add_status_val .= "VALUES ('$jon','$notes'";
		
		if(isset($_POST['status']) && $_POST['status']!=NULL){
			$status = $_POST['status'];
			$add_status .= ",status";
			$add_status_val .= ",'$status'";
		}

		$add_status .= ",updated_on,updated_by)";
		$add_status_val .= ",NOW(),'$encoder')";
		$add_status_com = $add_status." ".$add_status_val;

		$duple_query="SELECT * FROM jo WHERE (job_no='$jon')";
		$duple_result=mysqli_query($conn,$duple_query);
		$duple=mysqli_num_rows($duple_result);
		
		if($duple>0){?>
			<script type="text/javascript">
				swal({
					title: "Failed!",
					text: "Job Order already existed!",
					type: "error"
				},function(isConfirm){
					if(isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script><?php
		}else{
			//Execute
			if(mysqli_query($conn,$add_jo_com)){
				if(isset($_POST['status']) && $_POST['status']!=NULL){
					mysqli_query($conn,$add_status_com);
				}

				if($copies>0){
					mysqli_query($conn,$add_copy_com);		
				}?>

				<script type="text/javascript">
					swal({
						title: "Success!",
						text: "You encoded a new jobbing!",
						type: "success"
					},function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}
			else{?>
				<script type="text/javascript">
					swal({
						title: "Failed!",
						text: "Error adding a jobbing",
						type: "error"
					},function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>&add=2" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="jon" class="col-12 col-form-label">J.O. No.</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Job Order No." name="jon" id="jon" required>
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
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="koj" class="col-12 col-form-label">Job Kind</label>
				<div class="col-12">
					<select class="custom-select" name="koj" id="koj" required>
						<option value="" selected>None</option><?php
						$koj_query="SELECT * FROM jo_kinds WHERE job_type=2 GROUP BY job_kind ASC";
						$koj_result=mysqli_query($conn,$koj_query);
						if(mysqli_num_rows($koj_result)>0){
							while($koj=mysqli_fetch_array($koj_result)){?>
								<option value='<?php echo $koj['id'];?>'><?php echo $koj['job_kind'];?></option><?php
							}
						}else{?>
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
				<label for="koj" class="col-12 col-form-label">Agent</label>
				<div class="col-12">
					<select class="custom-select" name="ag" id="ag" required>
						<option value="" selected>None</option><?php
						$ag_query="SELECT * FROM users_list WHERE type=6 GROUP BY lastname,firstname,middlename ASC";
						$ag_result=mysqli_query($conn,$ag_query);
						if(mysqli_num_rows($ag_result)>0){
							while($ag=mysqli_fetch_array($ag_result)){?>
								<option value='<?php echo $ag['id'];?>'><?php echo $ag['lastname'].", ".$ag['firstname']." ".$ag['middlename'];?></option>"<?php
							}
						}else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="koj" class="col-12 col-form-label">Artist</label>
				<div class="col-12">
					<select class="custom-select" name="ar" id="ar" required>
						<option value="" selected>None</option><?php
						$ar_query="SELECT * FROM users_list WHERE (type=4 OR type=5 OR type=7) GROUP BY lastname,firstname,middlename ASC";
						$ar_result=mysqli_query($conn,$ar_query);
						if(mysqli_num_rows($ar_result)>0){
							while($ar=mysqli_fetch_array($ar_result)){?>
								<option value='<?php echo $ar['id'];?>'><?php echo $ar['lastname'].", ".$ar['firstname']." ".$ar['middlename'];?></option>"<?php
							}
						}else{?>
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
				<label for="color" class="col-12 col-form-label">Color</label>
				<div class="col-12">
					<select class="custom-select" name="color" id="color">
						<option value="" selected>None</option><?php
						$color_query="SELECT * FROM jo_colors GROUP BY color";
						$color_result=mysqli_query($conn,$color_query);
						if(mysqli_num_rows($color_result)>0){
							while($color=mysqli_fetch_array($color_result)){?>
								<option value='<?php echo $color['id'];?>'><?php echo $color['color'];?></option><?php
							}
						}else{?>
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
							while($materials=mysqli_fetch_array($materials_result)){?>
								<option value='<?php echo $materials['id'];?>'><?php echo $materials['materials'];?></option>"<?php
							}
						}else{?>
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
							while($size=mysqli_fetch_array($size_result)){?>
								<option value='<?php echo $size['id'];?>'><?php echo $size['size'];?></option><?php
							}
						}else{?>
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
						<option value="" selected>None</option><?php
						$cu_query="SELECT * FROM joc_units GROUP BY units ASC";
						$cu_result=mysqli_query($conn,$cu_query);
						if(mysqli_num_rows($cu_result)>0){
							while($cu=mysqli_fetch_array($cu_result)){?>
								<option value="<?php echo $cu['id'];?>"><?php echo $cu['units'];?></option><?php
							}
						}else{?>
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
						if(mysqli_num_rows($printing_result)>0)						{
							while($printing=mysqli_fetch_array($printing_result)){?>
								<option value='<?php echo $printing['id'];?>'><?php echo $printing['printing'];?></option>"<?php
							}
						}else{?>
							Not Available<?php
						}?>
					</select>
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
	
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="payment" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<select class="custom-select" name="payment" id="payment">
						<option value="" selected>None</option><?php
						$payment_query="SELECT * FROM jo_payments GROUP BY payment ASC";
						$payment_result=mysqli_query($conn,$payment_query);
						if(mysqli_num_rows($payment_result)>0){
							while($payment=mysqli_fetch_array($payment_result)){?>
								<option value="<?php echo $payment['id'];?>"><?php echo $payment['payment'];?></option><?php
							}
						}else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="units" class="col-12 col-form-label">Status</label>
				<div class="col-12">
					<select class="custom-select" name="status" id="status">
						<option value="" selected>None</option><?php
						$st_query="SELECT * FROM jos_list";
						$st_result=mysqli_query($conn,$st_query);
						if(mysqli_num_rows($st_result)>0){
							while($st=mysqli_fetch_array($st_result)){?>
								<option value="<?php echo $st['id'];?>"><?php echo $st['status'];?></option><?php
							}
						}else{?>
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
				<label for="notes" class="col-12 col-form-label">Notes</label>
				<div class="col-12">
					<textarea class="form-control" type="number" placeholder="Enter Notes" name="notes" id="notes" rows="10" style="resize: none;"></textarea>
				</div>
			</div>
		</div>
	</div>

	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="add_small_save">Save Jobbing</button>
	</div>
</form>