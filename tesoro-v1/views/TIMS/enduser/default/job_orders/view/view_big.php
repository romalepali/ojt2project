<?php
	if (isset($_POST['edit_big_save'])) {
		$des = mysqli_real_escape_string($conn,$_POST['des']);
		$customer = mysqli_real_escape_string($conn,$_POST['customer']);
		$agent = mysqli_real_escape_string($conn,$_POST['agent']);
		$artist = mysqli_real_escape_string($conn,$_POST['artist']);
		$cover = mysqli_real_escape_string($conn,$_POST['cover']);
		$pages = mysqli_real_escape_string($conn,$_POST['pages']);

		$big_save = "UPDATE jobbings SET description='$des',customer='$customer',agent='$agent',artist='$artist',cover='$cover',pages='$pages' WHERE id=".$_GET['view'];

		if(mysqli_query($conn,$big_save))
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

	if (isset($_POST['update_big_save'])) {
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
		$on= mysqli_real_escape_string($conn,$_SESSION['old_notes']);
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

	$query="SELECT a.job_no AS 'jon',a.description AS 'des',a.date_received,a.due_date,a.agent,a.customer,a.artist,a.date_added,a.current_note,a.cover,a.pages,a.initial_copies,f.payment,b.kind_of_job AS 'koj',c.job_type AS 'jt',c.id AS 'type',d.status_name AS 'sn',e.unit FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind=b.id RIGHT JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id LEFT JOIN copies_units e ON a.copies_unit=e.id LEFT JOIN jobbings_payment f ON a.payment=f.id WHERE a.id=".$_GET['view'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="des" class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($row['des']!=NULL){ echo $row['des'];} else {echo "N/A";} ?>" id="des" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="customer" class="col-12 col-form-label">Customer</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($row['customer']!=NULL){echo $row['customer'];}else{echo "N/A";}?>" id="customer" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="koj" class="col-12 col-form-label">Kind of Job</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $row['koj'];?>" id="koj" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="jt" class="col-12 col-form-label">Job Type</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $row['jt'];?>" id="jt" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="agent" class="col-12 col-form-label">Agent</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($row['agent']!=NULL){echo $row['agent'];}else{echo "N/A";}?>" id="agent" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="artist" class="col-12 col-form-label">Artist</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($row['artist']!=NULL){echo $row['artist'];}else{echo "N/A";}?>" id="artist" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
      <div class="form-group row">
        <label for="cover" class="col-12 col-form-label">Cover</label>
        <div class="col-12">
          <input class="form-control" type="text" value="<?php if($row['cover']!=NULL){echo $row['cover'];}else{echo "N/A";}?>" id="cover" disabled>
        </div>
      </div>
    </div>

    <div class="col-xl">
			<div class="form-group row">
				<label for="copies" class="col-12 col-form-label">Copies</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $row['initial_copies'];?> <?php if($row['unit']!=NULL){ echo $row['unit'];}?>" id="copies" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
      <div class="form-group row">
        <label for="pages" class="col-12 col-form-label">Pages</label>
        <div class="col-12">
          <input class="form-control" type="text" value="<?php if($row['pages']!=NULL){echo $row['pages'];}else{echo "N/A";}?>" id="pages" disabled>
        </div>
      </div>
    </div>

    <div class="col-xl">
			<div class="form-group row">
				<label for="payment" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($row['payment']!=NULL){echo $row['payment'];}else{echo "N/A";}?>" id="payment" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="received" class="col-12 col-form-label">Date Received</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo date('F d, Y',strtotime($row['date_received']));?>" id="received" disabled>
				</div>
			</div>
		</div>
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="date_added" class="col-12 col-form-label">Date Added</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo date('F d, Y h:s A',strtotime($row['date_added']));?>" id="date_added" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="status" class="col-12 col-form-label">Current Status</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $row['sn'];?>" id="status" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="notes" class="col-12 col-form-label">Notes</label>
				<div class="col-12">
					<textarea class="form-control" rows="10" id="notes" style="resize: none;" disabled><?php if($row['current_note']!=NULL){echo $row['current_note'];}else{echo "N/A";}?></textarea>
				</div>
			</div>
		</div>
	</div>