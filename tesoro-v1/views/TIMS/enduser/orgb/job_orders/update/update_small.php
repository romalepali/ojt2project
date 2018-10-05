<?php
  $query="SELECT a.current_note,a.current_status,a.initial_copies,a.copies_unit,a.payment,a.status_date,a.due_date,d.status_name AS 'sn',e.unit FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind=b.id LEFT JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id LEFT JOIN copies_units e ON a.copies_unit=e.id WHERE a.id=".$_GET['update'];

  $result_set=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update'];?>" method="POST">
 <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="copies" class="col-12 col-form-label">Copies</label>
        <div class="col-12">
          <input class="form-control" type="number" placeholder="Enter Copies" name="copies" value="<?php echo $row['initial_copies'];?>" id="copies">
        </div>
      </div>
    </div>

    <div class="col-xl">
      <div class="form-group row">
        <label for="units" class="col-12 col-form-label">Units</label>
        <div class="col-12">
          <select class="custom-select" name="units" id="units">
            <option value="" selected disabled>Select</option>
            <?php
              $cu_query="SELECT * FROM copies_units GROUP BY unit ASC";
              $cu_result=mysqli_query($conn,$cu_query);
              if(mysqli_num_rows($cu_result)>0)
              {
                while($cu=mysqli_fetch_array($cu_result))
                {
                  if($cu['id']==$row['copies_unit']){
                    ?><option value="<?php echo $cu['id'];?>" selected><?php echo $cu['unit'];?></option><?php
                  }
                  else{
                    ?><option value="<?php echo $cu['id'];?>"><?php echo $cu['unit'];?></option><?php
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
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="payment" class="col-12 col-form-label">Payment</label>
        <div class="col-12">
          <select class="custom-select" name="payment" id="payment">
            <option value="" selected disabled>Select</option>
            <?php
              $payment_query="SELECT * FROM jobbings_payment GROUP BY payment ASC";
              $payment_result=mysqli_query($conn,$payment_query);
              if(mysqli_num_rows($payment_result)>0)
              {
                while($payment=mysqli_fetch_array($payment_result))
                {
                  if($payment['id']==$row['payment']){
                    ?><option value="<?php echo $payment['id'];?>" selected><?php echo $payment['payment'];?></option><?php
                  }
                  else{
                    ?><option value="<?php echo $payment['id'];?>"><?php echo $payment['payment'];?></option><?php
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
        <label for="due_date" class="col-12 col-form-label">Due Date</label>
        <div class="col-12">
          <input class="form-control" type="date" placeholder="YYYY-MM-DD" name="due_date" value="<?php echo $row['due_date'];?>" id="due_date">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="status" class="col-12 col-form-label">Current Status</label>
        <div class="col-12">
          <select class="custom-select" name="status" required>
            <option value="" disabled>Select</option>
            <?php
              $status_query="SELECT * FROM jobbings_statuses GROUP BY status_name";
              $status_result=mysqli_query($conn,$status_query);
              if(mysqli_num_rows($status_result)>0)
              {
                while($status=mysqli_fetch_array($status_result))
                {
                  if($status['id']==$row['current_status']){
                    $_SESSION['old_status']=$row['current_status'];
                    ?><option value='<?php echo $status['id'];?>' selected><?php echo $status['status_name'];?></option>"<?php
                  }
                  else{
                    ?><option value='<?php echo $status['id'];?>'><?php echo $status['status_name'];?></option>"<?php
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
        <label for="notes" class="col-12 col-form-label">Current Note</label>
        <div class="col-12">
          <textarea class="form-control" rows="10" placeholder="Enter Notes" name="notes" id="notes" style="resize: none;"><?php echo $row['current_note'];?></textarea>
        </div>
      </div>
    </div>
  </div>
  <?php 
    if(isset($row['copies_unit'])){
      $_SESSION['old_unit'] = $row['copies_unit'];
    }else{
      $_SESSION['old_unit'] = 0;
    }

    $_SESSION['old_date']=$row['status_date'];
    $_SESSION['old_copies']=$row['initial_copies'];

    if(isset($row['payment'])){
      $_SESSION['old_payment'] = $row['payment'];
    }else{
      $_SESSION['old_payment'] = 0;
    }

    $_SESSION['old_notes']=$row['current_note'];
    
    $_SESSION['old_ddate']=$row['due_date'];
  ?>
  <div style="float: right; padding: 20px 0px">
    <a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update'];?>">Cancel</a>
    <button class="btn btn-primary" type="submit" name="update_small_save">Update</button>
  </div>
</form>