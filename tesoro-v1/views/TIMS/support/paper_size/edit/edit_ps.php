<?php
	if (isset($_POST['edit_ps_save'])) {
	$ps = $_POST['ps'];

    $ps_save = "UPDATE printing_paper_size SET size='$ps' WHERE id=".$_GET['edit'];
    if(mysqli_query($conn,$ps_save))
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
	$query="SELECT * FROM printing_paper_size WHERE id=".$_GET['edit'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>?edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="ps" class="col-12 col-form-label">Paper Size</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Paper Size" value="<?php echo $row['size'];?>" name="ps" id="ps" required>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_ps_save">Save Changes</button>
	</div>
</form>