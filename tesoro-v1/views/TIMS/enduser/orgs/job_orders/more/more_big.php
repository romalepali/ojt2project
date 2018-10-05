<div class="table-responsive">
  <table class="table table-hover" id="myTable">
    <thead>
      <tr>
        <th onclick="sortTable(0)" class="tableSort">Copies</th>
        <th onclick="sortTable(1)" class="tableSort">Payment</th>
        <th onclick="sortTable(2)" class="tableSort">Status</th>
        <th onclick="sortTable(3)" class="tableSort">Notes</th>
        <th onclick="sortTable(4)" class="tableSort">Status Date</th>
        <th onclick="sortTable(5)" class="tableSort">Due Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql_query="SELECT a.id, a.notes, a.status_date, a.copies, a.due_date, b.status_name, c.unit, d.payment FROM jobbings_status a LEFT JOIN jobbings_statuses b ON a.status=b.id  LEFT JOIN copies_units c ON a.units=c.id LEFT JOIN jobbings_payment d ON a.payment=d.id WHERE a.job_id=".$_GET['more']." ORDER BY a.id DESC";
        $result_set=mysqli_query($conn,$sql_query);
        if(mysqli_num_rows($result_set)>0){
          while($row=mysqli_fetch_assoc($result_set)){
          ?>  
          <tr> 
            <td><?php echo $row['copies']." ".$row['unit'];?></td>
            <td><?php if($row['payment']!=NULL){echo $row['payment'];}else{echo "N/A";}?></td>
            <td><?php if($row['status_name']!=NULL){echo $row['status_name'];}else{echo "N/A";}?></td>
            <td><?php if($row['notes']!=NULL){echo $row['notes'];}else{echo "N/A";}?></td>
            <td><?php echo date('F d, Y',strtotime($row['status_date']));?></td>
            <td><?php 
              if(round(((strtotime($row['due_date'])/24)/60)/60) == 0)
              {
                echo "Not set";
              }else{
                echo date('F d, Y',strtotime($row['due_date']));
              }?>
            </td>
          </tr>
          <?php
          }   
        }
        else{
        ?>
          <tr>
            <td colspan="6" style="text-align: center;">No data yet!</td>
          </tr>
        <?php
        }
      ?>
     </tbody>
   </table>
</div>