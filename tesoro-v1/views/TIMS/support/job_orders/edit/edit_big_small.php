<?php
//Big Jobs Only
  $query="SELECT a.job_no AS 'jon',a.description AS 'des',a.date_received,a.due_date,a.agent,a.customer,a.artist,a.date_added,a.current_note,a.cover,a.current_status,a.pages,a.initial_copies,a.size AS 'size_id',a.copies_unit,b.kind_of_job AS 'koj',c.job_type AS 'jt',c.id AS 'type',d.status_name AS 'sn',e.unit FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind=b.id RIGHT JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id LEFT JOIN copies_units e ON a.copies_unit=e.id WHERE a.id=".$_GET['edit'];

  $result_set=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['edit'];?>" method="POST">
  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="des" class="col-12 col-form-label">Description</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Description" value="<?php echo $row['des'];?>" name="des" id="des">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="customer" class="col-12 col-form-label">Customer</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Customer" value="<?php echo $row['customer'];?>" name="customer" id="customer" required>
        </div>
      </div>
    </div>

    <div class="col-xl">
      <div class="form-group row">
        <label for="agent" class="col-12 col-form-label">Agent</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Agent" value="<?php echo $row['agent'];?>" name="agent" id="agent">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="artist" class="col-12 col-form-label">Artist</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Artist" value="<?php echo $row['artist'];?>" name="artist" id="artist">
        </div>
      </div>
    </div>

    <div class="col-xl">
      <div class="form-group row">
        <label for="cover" class="col-12 col-form-label">Cover</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Cover" value="<?php echo $row['cover'];?>" name="cover" id="cover">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="pages" class="col-12 col-form-label">Pages</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Pages" value="<?php echo $row['pages'];?>" name="pages" id="pages">
        </div>
      </div>
    </div>

    <div class="col-xl">
      <div class="form-group row">
        <label for="size" class="col-12 col-form-label">Size</label>
        <div class="col-12">
          <select class="custom-select" name="size" id="size">
            <option value="" selected disabled>Select</option>
            <?php
              $size_query="SELECT * FROM printing_paper_size GROUP BY size";
              $size_result=mysqli_query($conn,$size_query);
              if(mysqli_num_rows($size_result)>0)
              {
                while($size=mysqli_fetch_array($size_result))
                {
                  if($size['id']==$row['size_id']){
                    ?><option value='<?php echo $size['id'];?>' selected><?php echo $size['size'];?></option>"<?php
                  }
                  else{
                    ?><option value='<?php echo $size['id'];?>'><?php echo $size['size'];?></option>"<?php
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
  <div style="float: right; padding: 20px 0px">
	  <a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['edit'];?>">Cancel</a>
	  <button class="btn btn-primary" type="submit" name="edit_big_small_save">Save Changes</button>
	</div>
</form>