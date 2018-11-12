<?php
if (isset($_POST['add_pt_save'])) {
    $pt = $_POST['pt'];
    $add = $_SESSION['user_id'];

    $add_query = "INSERT INTO jo_printing (printing,updated_by,updated_on) VALUES ('$pt','$add',NOW())";


    $duple_query="SELECT * FROM jo_printing WHERE BINARY (printing='$pt')";
    $duple_result=mysqli_query($conn,$duple_query);
    $duple=mysqli_num_rows($duple_result);
        
    if($duple>0){
      ?>
        <script type="text/javascript">
          swal({
            title: "Failed",
            text: "Printing already existed!",
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
            text: "You added a new printing!",
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
            text: "Error adding a printing!",
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
        <label for="pt" class="col-12 col-form-label">Printing</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Printing" name="pt" id="pt" autofocus required>
        </div>
      </div>
    </div>
  </div>
  <div style="float: right; padding: 20px 0px">
      <a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
      <button class="btn btn-primary" type="submit" name="add_pt_save">Save Printing</button>
  </div>
</form>