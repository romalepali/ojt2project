<?php
if (isset($_POST['add_un_save'])) {
    $un = $_POST['un'];
    $add = $_SESSION['user_id'];

    $add_query = "INSERT INTO joc_units (units,updated_by,updated_on) VALUES ('$un','$add',NOW())";

    $duple_query="SELECT * FROM joc_units WHERE BINARY (units='$un')";
    $duple_result=mysqli_query($conn,$duple_query);
    $duple=mysqli_num_rows($duple_result);
        
    if($duple>0){
      ?>
        <script type="text/javascript">
          swal({
            title: "Failed",
            text: "Unit already existed!",
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
            title: "Success",
            text: "You added a new unit!",
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
            text: "Error adding a unit!",
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

<form action="<?php echo $_SESSION['page'];?>&add=true" method="POST">
  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="un" class="col-12 col-form-label">Unit</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Unit" name="un" id="un" autofocus required>
        </div>
      </div>
    </div>
  </div>
  <div style="float: right; padding: 20px 0px">
      <a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
      <button class="btn btn-primary" type="submit" name="add_un_save">Save Unit</button>
  </div>
</form>