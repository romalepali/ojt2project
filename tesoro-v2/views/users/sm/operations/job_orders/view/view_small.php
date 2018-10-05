<?php
	if (isset($_POST['edit_small_save'])) {
		$agent = mysqli_real_escape_string($conn,$_POST['agent']);
		$des = mysqli_real_escape_string($conn,$_POST['des']);
		$customer = mysqli_real_escape_string($conn,$_POST['customer']);
		$artist = mysqli_real_escape_string($conn,$_POST['artist']);

		if(isset($_POST['color'])){
			$color = $_POST['color'];
		}else{
			$color = 0;
		}

		$pages = mysqli_real_escape_string($conn,$_POST['pages']);

		if(isset($_POST['materials'])){
			$materials = $_POST['materials'];
		}else{
			$materials = 0;
		}

		if(isset($_POST['size'])){
			$size = $_POST['size'];
		}else{
			$size = 0;
		}

		if(isset($_POST['printing'])){
			$printing = $_POST['printing'];
		}else{
			$printing = 0;
		}

		$small_save = "UPDATE jobbings SET description='$des', agent='$agent',customer='$customer',artist='$artist',color='$color',pages='$pages',materials='$materials',size='$size',printing='$printing' WHERE id=".$_GET['view'];

		if(mysqli_query($conn,$small_save))
		{
		?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "Your changes are applied",
					type: "success"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['view']?>';
					}
				});
			</script>
			<?php
		}
		else
		{
			?>
				<script type="text/javascript">
					swal({
					title: "Failed!",
					text: "No changes applied",
					type: "error"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['view']?>';
					}
				});
				</script>
			<?php
		}
	}

	if (isset($_POST['update_small_save'])) {
		$copies = $_POST['copies'];

		if(isset($_POST['payment'])){
			$payment = $_POST['payment'];
		}else{
			$payment = 0;
		}

		if(isset($_POST['units'])){
			$units = $_POST['units'];
		}else{
			$units = 0;
		}
		$status = $_POST['status'];
		$notes = mysqli_real_escape_string($conn,$_POST['notes']);
		$due_date = $_POST['due_date'];

		$joid = $_GET['view'];
		$op= $_SESSION['old_payment'];
		$odd= $_SESSION['old_ddate'];
		$ic= $_SESSION['old_copies'];
		$cu= $_SESSION['old_unit'];
		$ot= $_SESSION['old_status'];
		$on= $_SESSION['old_notes'];
		$od= $_SESSION['old_date'];

		$new_status = "UPDATE jobbings SET initial_copies='$copies',copies_unit='$units',current_status='$status',current_note='$notes',payment='$payment',due_date='$due_date' WHERE id=".$_GET['view'];

		$old_status = "INSERT INTO jobbings_status (job_id,copies,units,payment,status,notes,status_date,due_date) VALUES ('$joid','$ic','$cu','$op','$ot','$on','$od','$odd')";

		if(mysqli_query($conn,$new_status) && mysqli_query($conn,$old_status))
		{
		?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "Your updates are applied",
					type: "success"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['view']?>';
					}
				});
			</script>
			<?php
		}
		else
		{
			?>
				<script type="text/javascript">
					swal({
					title: "Failed!",
					text: "No updates applied",
					type: "error"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['view']?>';
					}
				});
				</script>
			<?php
		}
	}  
	
	$jo_query="SELECT a.job_no,a.description,a.customer,a.agent,a.artist,b.job_kind,c.job_type,d.firstname AS 'agf',d.lastname AS 'agl',e.firstname AS 'arf',e.lastname AS 'arl',a.pages,f.color,g.materials,h.size,i.printing,j.payment,a.received_on,a.encoded_on FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN jo_type c ON b.job_type=c.id LEFT JOIN users_list d ON a.agent=d.id LEFT JOIN users_list e ON a.artist=e.id LEFT JOIN jo_colors f ON a.color=f.id LEFT JOIN jo_materials g ON a.materials=g.id LEFT JOIN jo_size h ON a.size=h.id LEFT JOIN jo_printing i ON a.printing=i.id LEFT JOIN jo_payments j ON a.payment=j.id WHERE a.job_no=".$_GET['view'];

	$jo_result=mysqli_query($conn,$jo_query);
	$jo=mysqli_fetch_array($jo_result);
?>
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="des" class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['description']!=NULL){ echo $jo['description'];} else {echo "N/A";} ?>" id="des" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="customer" class="col-12 col-form-label">Customer</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['customer']!=NULL){echo $jo['customer'];}else{echo "N/A";}?>" id="customer" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="koj" class="col-12 col-form-label">Job Kind</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $jo['job_kind'];?>" id="koj" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="jt" class="col-12 col-form-label">Job Type</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $jo['job_type'];?>" id="jt" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="agent" class="col-12 col-form-label">Agent</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['agent']!=NULL){echo $jo['agf']." ".$jo['agl'];}else{echo "N/A";}?>" id="agent" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="artist" class="col-12 col-form-label">Artist</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['artist']!=NULL){echo $jo['arf']." ".$jo['arl'];}else{echo "N/A";}?>" id="artist" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="pages" class="col-12 col-form-label">Pages</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['pages']!=NULL){echo $jo['pages'];}else{echo "N/A";}?>" id="text" disabled>
				</div>
			</div>
		</div>
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="color" class="col-12 col-form-label">Color</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['color']!=NULL){echo $jo['color'];}else{echo "N/A";}?>" id="color" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="materials" class="col-12 col-form-label">Materials</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['materials']!=NULL){echo $jo['materials'];}else{echo "N/A";}?>" id="materials" disabled>
				</div>
			</div>
		</div>
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="size" class="col-12 col-form-label">Size</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['size']!=NULL){echo $jo['size'];}else{echo "N/A";}?>" id="size" disabled>
				</div>
			</div>
		</div>	
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="printing" class="col-12 col-form-label">Printing</label>
				<div class="col-12">
					<input class="form-control" type="textl" value="<?php if($jo['printing']!=NULL){echo $jo['printing'];}else{echo "N/A";}?>" id="printing" disabled>
				</div>
			</div>
		</div><?php

		$total_copies = 0;
		$units = "";
		$copies_query="SELECT a.copies,b.units FROM jo_copies a LEFT JOIN joc_units b ON a.units=b.id WHERE a.job_no=".$jo['job_no']." ORDER BY a.added_on DESC";
		$copies_result=mysqli_query($conn,$copies_query);
		if(mysqli_num_rows($copies_result)>0){
			while($copies=mysqli_fetch_assoc($copies_result)){
				$total_copies += $copies['copies'];
				$units = $copies['units'];
			}
		}?>

    	<div class="col-xl">
			<div class="form-group row">
				<label for="copies" class="col-12 col-form-label">Total Copies</label>
					<div class="col-12">
						<div class="input-group">
							<input class="form-control" type="text" value="<?php if($total_copies>0){echo $total_copies;}else{echo "N/A";}?> <?php if($units!=NULL){echo $units;}?>" id="copies" disabled>
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" onclick="copies('<?php echo $_GET['view']; ?>')">more info</button>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="received" class="col-12 col-form-label">Received On</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo date('F d, Y',strtotime($jo['received_on']));?>" id="received" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="date_added" class="col-12 col-form-label">Encoded On</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo date('F d, Y h:s A',strtotime($jo['encoded_on']));?>" id="date_added" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="payment" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['payment']!=NULL){echo $jo['payment'];}else{echo "N/A";}?>" id="payment" disabled>
				</div>
			</div>
		</div><?php

		$status_query="SELECT a.notes,b.status FROM jo_status a INNER JOIN jos_list b ON a.status=b.id WHERE a.job_no=".$jo['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
		$status_result=mysqli_query($conn,$status_query);
		if(mysqli_num_rows($status_result)>0){
			while($status=mysqli_fetch_assoc($status_result)){?>

		<div class="col-xl">
			<div class="form-group row">
				<label for="status" class="col-12 col-form-label">Current Status</label>
				<div class="col-12">
					<div class="input-group">
						<input class="form-control" type="text" value="<?php echo $status['status'];?>" id="status" disabled>
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" onclick="status('<?php echo $_GET['view']; ?>')">more info</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="notes" class="col-12 col-form-label">Notes</label>
				<div class="col-12">
					<textarea class="form-control" rows="10" id="notes" style="resize: none;" disabled><?php if($status['notes']!=NULL){echo $status['notes'];}else{echo "N/A";}?></textarea>
				</div>
			</div>
		</div>
	</div><?php	}
	}else{?>
		<div class="col-xl">
			<div class="form-group row">
				<label for="status" class="col-12 col-form-label">Current Status</label>
				<div class="col-12">
					<div class="input-group">
						<input class="form-control" type="text" value="<?php echo "N/A";?>" id="status" disabled>
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" onclick="status('<?php echo $_GET['view']; ?>')">more info</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="notes" class="col-12 col-form-label">Notes</label>
				<div class="col-12">
					<textarea class="form-control" rows="10" id="notes" style="resize: none;" disabled><?php echo "N/A";?></textarea>
				</div>
			</div>
		</div>
	</div><?php
	}
?>