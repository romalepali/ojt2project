<?php
	if (isset($_POST['edit_st_save'])) {
		$st = $_POST['st'];

    $st_save = "UPDATE jobbings_statuses SET status_name='$st' WHERE id=".$_GET['edit'];
    if(mysqli_query($conn,$st_save))
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
          text: "No changes applied",
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

//Big Jobs Only
	$query="SELECT * FROM jobbings_statuses WHERE id=".$_GET['edit'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>?edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="st" class="col-12 col-form-label">Status</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Status" value="<?php echo $row['status_name'];?>" name="st" id="st" required>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_st_save">Save Changes</button>
	</div>
</form>