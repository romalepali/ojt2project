<?php
if (isset($_POST['add_big_save'])) {
		$jon = $_POST['jon'];
		$koj = $_POST['koj'];
		$des = mysqli_real_escape_string($conn,$_POST['des']);
		$dr = $_POST['dr'];
		$dd = $_POST['dd'];
		$agent = mysqli_real_escape_string($conn,$_POST['agent']);
		$customer = mysqli_real_escape_string($conn,$_POST['customer']);
		$artist = mysqli_real_escape_string($conn,$_POST['artist']);
		$pages = mysqli_real_escape_string($conn,$_POST['pages']);
		$copies = $_POST['copies'];

		if(isset($_POST['units'])){
			$units = $_POST['units'];
		}else{
			$units = 0;
		}

		if(isset($_POST['payment'])){
			$payment = $_POST['payment'];
		}else{
			$payment = 0;
		}
		
		if(isset($_POST['size'])){
			$size = $_POST['size'];
		}else{
			$size = 0;
		}


		$status = $_POST['status'];
		$notes = mysqli_real_escape_string($conn,$_POST['notes']);
		$cover = mysqli_real_escape_string($conn,$_POST['cover']);
		$added_by = $_SESSION['TIMS_id'];
		$updated_by = $_SESSION['TIMS_id'];

		$add = "INSERT INTO jobbings (job_no,job_kind,description,date_received,due_date,agent,customer,artist,current_status,current_note,status_date,added_by,updated_by,cover,size,pages,initial_copies,copies_unit,payment,date_added) VALUES ('$jon','$koj','$des','$dr','$dd','$agent','$customer','$artist','$status','$notes',NOW(),'$added_by','$updated_by','$cover','$size','$pages','$copies','$units','$payment',NOW())";

		if(mysqli_query($conn,$add))
		{
		?>
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
			</script>
			<?php
		}
		else
		{
			?>
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
				</script>
			<?php
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>?add=big_small" method="POST">
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
        <label for="koj" class="col-12 col-form-label">Kind of Job</label>
        <div class="col-12">
          <select class="custom-select" name="koj" id="koj" required>
            <option value="" selected disabled>Select</option>
            <?php
              $koj_query="SELECT * FROM jobbings_kinds WHERE type=3 GROUP BY kind_of_job ASC";
              $koj_result=mysqli_query($conn,$koj_query);
              if(mysqli_num_rows($koj_result)>0)
              {
                while($koj=mysqli_fetch_array($koj_result))
                {
                    ?><option value='<?php echo $koj['id'];?>'><?php echo $koj['kind_of_job'];?></option>"<?php
                }
              }
              else
              {
              ?>
                Not Available
              <?php
              }
            ?>
          </select>
        </div>
      </div>
    </div>

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
				<label for="agent" class="col-12 col-form-label">Agent</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Agent" name="agent" id="agent">
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="artist" class="col-12 col-form-label">Artist</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Artist" name="artist" id="artist">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="cover" class="col-12 col-form-label">Cover</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Cover" name="cover" id="cover">
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="pages" class="col-12 col-form-label">Pages</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Pages" name="pages" id="text">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="dr" class="col-12 col-form-label">Date Received</label>
				<div class="col-12">
					<input class="form-control" type="date" placeholder="YYYY-MM-DD" name="dr" id="dr" required>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="dd" class="col-12 col-form-label">Due Date</label>
				<div class="col-12">
					<input class="form-control" type="date" placeholder="YYYY-MM-DD" name="dd" id="dd">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="copies" class="col-12 col-form-label">Copies</label>
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
						<option value="0" selected disabled>Select</option>
						<?php
							$cu_query="SELECT * FROM copies_units GROUP BY unit ASC";
							$cu_result=mysqli_query($conn,$cu_query);
							if(mysqli_num_rows($cu_result)>0)
							{
								while($cu=mysqli_fetch_array($cu_result))
								{
										?><option value="<?php echo $cu['id'];?>"><?php echo $cu['unit'];?></option><?php
								}
							}
							else
							{
								?>
									Not Available
								<?php
							}
						?>
					</select>
				</div>
			</div>
		</div>		
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="size" class="col-12 col-form-label">Size</label>
				<div class="col-12">
					<select class="custom-select" name="size" id="size">
						<option value="" selected disabled>Select</option>
						<?php
							$size_query="SELECT * FROM printing_paper_size GROUP BY size";
							$size_result=mysqli_query($conn,$size_query);
							if(mysqli_num_rows($size_result)>0)
							{
								while($size=mysqli_fetch_array($size_result))
								{
										?><option value='<?php echo $size['id'];?>'><?php echo $size['size'];?></option>"<?php
								}
							}
							else
							{
							?>
								Not Available
							<?php
							}
						?>
					</select>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="payment" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<select class="custom-select" name="payment" id="payment">
						<option value="" selected disabled>Select</option>
						<?php
							$payment_query="SELECT * FROM jobbings_payment GROUP BY payment ASC";
							$payment_result=mysqli_query($conn,$payment_query);
							if(mysqli_num_rows($payment_result)>0)
							{
								while($payment=mysqli_fetch_array($payment_result))
								{
										?><option value="<?php echo $payment['id'];?>"><?php echo $payment['payment'];?></option><?php
								}
							}
							else
							{
								?>
									Not Available
								<?php
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="status" class="col-12 col-form-label">Status</label>
				<div class="col-12">
					<select class="custom-select" name="status" required>
						<option value="" selected disabled>Select</option>
						<?php
							$status_query="SELECT * FROM jobbings_statuses GROUP BY status_name";
							$status_result=mysqli_query($conn,$status_query);
							if(mysqli_num_rows($status_result)>0)
							{
								while($status=mysqli_fetch_array($status_result))
								{
										?><option value='<?php echo $status['id'];?>'><?php echo $status['status_name'];?></option>"<?php
								}
							}
							else
							{
							?>
								Not Available
							<?php
							}
						?>
					</select>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="notes" class="col-12 col-form-label">Note</label>
				<div class="col-12">
					<textarea class="form-control" rows="10" placeholder="Enter Notes" name="notes" id="notes" style="resize: none;"></textarea>
				</div>
			</div>
		</div>
	</div>

	<div style="float: right; padding: 20px 0px">
			<a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
			<button class="btn btn-primary" type="submit" name="add_big_save">Save Jobbing</button>
	</div>
</form>
