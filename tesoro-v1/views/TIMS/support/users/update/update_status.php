<?php
  if (isset($_POST['update_user'])) {
    $type = $_POST['type'];
    $status = $_POST['status'];

    $update_user = "UPDATE users SET type='$type',status='$status' WHERE id=".$_GET['update'];

    if(mysqli_query($conn,$update_user))
    {
    ?>
      <script type="text/javascript">
        swal({
          title: "Success!",
          text: "User updates are applied",
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
          text: "No updates applied",
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

  $query="SELECT a.*,b.name FROM users a LEFT JOIN users_privileges b ON a.type=b.id WHERE a.id=".$_GET['update'];

  $result_set=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>?update=<?php echo $_GET['update'];?>" method="POST">
  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="type" class="col-12 col-form-label">User Type</label>
        <div class="col-12">
          <select class="custom-select" name="type" id="type" required>
            <option value="" disabled selected>Select</option>
            <?php
              $type_query="SELECT * FROM users_privileges";
              $type_result=mysqli_query($conn,$type_query);
              if(mysqli_num_rows($type_result)>0)
              {
                while($type=mysqli_fetch_array($type_result))
                {
                  if($type['id']==$row['type']){
                    ?><option value="<?php echo $type['id'];?>" selected><?php echo $type['name'];?></option><?php
                  }
                  else{
                    ?><option value="<?php echo $type['id'];?>"><?php echo $type['name'];?></option><?php
                  }
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
        <label for="status" class="col-12 col-form-label">Status</label>
        <div class="col-12">
          <select class="custom-select" name="status" id="status" required>
            <option value="" disabled selected>Select</option>
            <?php
              if($row['status']=="Active"){
                ?>
                  <option value='Active' selected>Active</option>
                  <option value='Inactive'>Inactive</option>
                <?php
              }
              else{
                ?>
                  <option value='Active'>Active</option>
                  <option value='Inactive' selected>Inactive</option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div style="float: right; padding: 20px 0px">
    <a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
    <button class="btn btn-primary" type="submit" name="update_user">Update</button>
  </div>
</form>