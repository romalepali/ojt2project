<?php
if (isset($_POST['add_mt_save'])) {
    $mt = $_POST['mt'];
    $add = $_SESSION['TIMS_id'];

    $add_query = "INSERT INTO printing_materials (materials,added_by) VALUES ('$mt','$add')";

    $duple_query="SELECT * FROM printing_materials WHERE BINARY (materials='$mt')";
    $duple_result=mysqli_query($conn,$duple_query);
    $duple=mysqli_num_rows($duple_result);
        
    if($duple>0){
      ?>
        <script type="text/javascript">
          swal({
            title: "Failed!",
            text: "Material already existed!",
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
            text: "You added a new material!",
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
            text: "Error adding a material!",
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
        <label for="mt" class="col-12 col-form-label">Material</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Material" name="mt" id="mt" required>
        </div>
      </div>
    </div>
  </div>
  <div style="float: right; padding: 20px 0px">
      <a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
      <button class="btn btn-primary" type="submit" name="add_mt_save">Save Material</button>
  </div>
</form>