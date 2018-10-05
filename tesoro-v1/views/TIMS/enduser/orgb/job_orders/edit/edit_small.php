<?php
  $query="SELECT a.job_no AS 'jon',a.description AS 'des',a.date_received,a.due_date,a.agent,a.customer,a.artist,a.date_added,a.current_note,a.cover,a.pages,a.initial_copies,a.printing AS 'printing_id',a.size AS 'size_id',a.color AS 'color_id',a.materials AS 'mat_id',b.kind_of_job AS 'koj',c.job_type AS 'jt',c.id AS 'type',d.status_name AS 'sn',e.unit,f.color,g.materials,h.size,i.printing FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind=b.id RIGHT JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id LEFT JOIN copies_units e ON a.copies_unit=e.id LEFT JOIN printing_colors f ON a.color=f.id LEFT JOIN printing_materials g ON a.materials=g.id LEFT JOIN printing_paper_size h ON a.size=h.id LEFT JOIN printing i ON a.printing=i.id WHERE a.id=".$_GET['edit'];

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
          <input class="form-control" type="text" placeholder="Enter Customer" name="customer" value="<?php echo $row['customer'];?>" id="customer" required>
        </div>
      </div>
    </div>
    
    <div class="col-xl">
      <div class="form-group row">
        <label for="agent" class="col-12 col-form-label">Agent</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Agent" name="agent" value="<?php echo $row['agent'];?>" id="agent">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="artist" class="col-12 col-form-label">Artist</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Artist" name="artist" value="<?php echo $row['artist'];?>" id="artist">
        </div>
      </div>
    </div>

    <div class="col-xl">
      <div class="form-group row">
        <label for="pages" class="col-12 col-form-label">Pages</label>
        <div class="col-12">
          <input class="form-control" type="text" placeholder="Enter Pages" name="pages" value="<?php echo $row['pages'];?>" id="text">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="form-group row">
        <label for="color" class="col-12 col-form-label">Color</label>
        <div class="col-12">
          <select class="custom-select" name="color" id="color">
            <option value="" selected disabled>Select</option>
            <?php
              $color_query="SELECT * FROM printing_colors GROUP BY color";
              $color_result=mysqli_query($conn,$color_query);
              if(mysqli_num_rows($color_result)>0)
              {
                while($color=mysqli_fetch_array($color_result))
                {
                  if($color['id']==$row['color_id']){
                    ?><option value='<?php echo $color['id'];?>' selected><?php echo $color['color'];?></option>"<?php
                  }
                  else{
                    ?><option value='<?php echo $color['id'];?>'><?php echo $color['color'];?></option>"<?php
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
        <label for="materials" class="col-12 col-form-label">Materials</label>
        <div class="col-12">
          <select class="custom-select" name="materials" id="materials">
            <option value="" selected disabled>Select</option>
            <?php
              $materials_query="SELECT * FROM printing_materials GROUP BY materials";
              $materials_result=mysqli_query($conn,$materials_query);
              if(mysqli_num_rows($materials_result)>0)
              {
                while($materials=mysqli_fetch_array($materials_result))
                {
                  if($materials['id']==$row['mat_id']){
                    ?><option value='<?php echo $materials['id'];?>' selected><?php echo $materials['materials'];?></option>"<?php
                  }
                  else{
                    ?><option value='<?php echo $materials['id'];?>'><?php echo $materials['materials'];?></option>"<?php
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

    <div class="col-xl">
      <div class="form-group row">
        <label for="printing" class="col-12 col-form-label">Printing</label>
        <div class="col-12">
          <select class="custom-select" name="printing" id="printing">
            <option value="" selected disabled>Select</option>
            <?php
              $printing_query="SELECT * FROM printing GROUP BY printing";
              $printing_result=mysqli_query($conn,$printing_query);
              if(mysqli_num_rows($printing_result)>0)
              {
                while($printing=mysqli_fetch_array($printing_result))
                {
                  if($printing['id']==$row['printing_id']){
                    ?><option value='<?php echo $printing['id'];?>' selected><?php echo $printing['printing'];?></option>"<?php
                  }
                  else{
                    ?><option value='<?php echo $printing['id'];?>'><?php echo $printing['printing'];?></option>"<?php
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
      <a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['edit'];?>">Cancel</a>
      <button class="btn btn-primary" type="submit" name="edit_small_save">Save Changes</button>
    </div>
</form>