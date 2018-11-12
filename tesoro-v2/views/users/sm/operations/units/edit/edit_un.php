<?php
	if (isset($_POST['edit_un_save'])) {
	$un = $_POST['un'];
  $edit = $_SESSION['user_id'];

    $un_save = "UPDATE joc_units SET units='$un',updated_by='$edit',updated_on=NOW() WHERE id=".$_GET['edit'];
    if(mysqli_query($conn,$un_save))
    {
    ?>
      <script type="text/javascript">
        swal({
          title: "Success",
          text: "Your changes are applied!",
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
          title: "Failed",
          text: "No changes applied!",
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

	$query="SELECT * FROM joc_units WHERE id=".$_GET['edit'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="un" class="col-12 col-form-label">Unit</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Unit" value="<?php echo $row['units'];?>" name="un" id="un" autofocus required>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_un_save">Save Changes</button>
	</div>
</form>