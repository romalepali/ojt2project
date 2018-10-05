<?php
	if (isset($_POST['edit_pt_save'])) {
	$pt = $_POST['pt'];
  $edit = $_SESSION['user_id'];

    $pt_save = "UPDATE jo_printing SET printing='$pt',updated_by='$edit',updated_on=NOW() WHERE id=".$_GET['edit'];
    if(mysqli_query($conn,$pt_save))
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

	$query="SELECT * FROM jo_printing WHERE id=".$_GET['edit'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="pt" class="col-12 col-form-label">Printing</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Printing" value="<?php echo $row['printing'];?>" name="pt" id="pt" autofocus required>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_pt_save">Save Changes</button>
	</div>
</form>