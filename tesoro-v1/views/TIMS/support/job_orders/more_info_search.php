<?php
  if(is_numeric($_GET['more']) && $_GET['more']!=0){
    $query0="SELECT a.job_no AS 'jon', b.type AS 'type' FROM jobbings a INNER JOIN jobbings_kinds b ON a.job_kind=b.id WHERE a.id=".$_GET['more'];

    $result_set0=mysqli_query($conn,$query0);
    if(mysqli_num_rows($result_set0)>0){
      $row0=mysqli_fetch_array($result_set0);?>
      <div class="row">
        <div class="col-10">
          <h4 style="margin: 10px 0px;">J.O. No.: <?php echo $row0['jon'];?></h4>
        </div>
          <div class="col-2">
            <button class="btn btn-secondary" onclick="update('<?php echo $_GET['more']; ?>')" title="Update Status" style="font-size: 12px; height:32px; float: right; margin: 5px 0px 5px 5px;"><img src="images/update.png" width="12px" style="margin: -3px -3px 0px -3px;"></button>
        </div>
      </div>
      <div style="max-height: 75vh; overflow-x: hidden;">
      <?php if($row0['type']==1){
        //Big Jobs Only
        include ('more/more_big.php');
      }
      else if($row0['type']==2){
        //Small Jobs Only
        include ('more/more_small.php');
      }else if($row0['type']==3){
        //Small Jobs Only
        include ('more/more_big_small.php');
      }?>
      </div>
    <?php
    } else {?>
      <div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
        Sorry, job does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
      </div>
    <?php
    } 
  }else {?>
    <div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
      Sorry, job does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
    </div>
  <?php
  }
?>