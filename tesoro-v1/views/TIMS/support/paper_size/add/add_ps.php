<?php
if (isset($_POST['add_ps_save'])) {
    $ps = $_POST['ps'];
    $add = $_SESSION['TIMS_id'];

    $add_query = "INSERT INTO printing_paper_size (size,added_by) VALUES ('$ps','$add')";

    $duple_query="SELECT * FROM printing_paper_size WHERE BINARY (size='$ps')";
    $duple_result=mysqli_query($conn,$duple_query);
    $duple=mysqli_num_rows($duple_result);
        
    if($duple>0){
      ?>
        <script type="text/javascript">
          swal({
            title: "Failed!",
            text: "Printing size already existed!",
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
    else{
      if(mysqli_query($conn,$add_query))
      {
      ?>
        <script type="text/javascript">
          swal({
            title: "Success!",
            text: "You added a new paper size!",
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
            text: "Error adding a paper size!",
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
  }
?>

<form action="<?php echo $_SESSION['page'];?>?add=true" method="POST">
  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="ps" class="col-12 col-form-label">Paper Size</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Paper Size" name="ps" id="ps" required>
        </div>
      </div>
    </div>
  </div>
  <div style="float: right; padding: 20px 0px">
      <a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
      <button class="btn btn-primary" type="submit" name="add_ps_save">Save Paper Size</button>
  </div>
</form>