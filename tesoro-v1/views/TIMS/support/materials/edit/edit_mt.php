<?php
	if (isset($_POST['edit_mt_save'])) {
	$mt = $_POST['mt'];

    $mt_save = "UPDATE printing_materials SET materials='$mt' WHERE id=".$_GET['edit'];
    if(mysqli_query($conn,$mt_save))
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
	$query="SELECT * FROM printing_materials WHERE id=".$_GET['edit'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>?edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="mt" class="col-12 col-form-label">Materials</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Materials" value="<?php echo $row['materials'];?>" name="mt" id="mt" required>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_mt_save">Save Changes</button>
	</div>
</form>