<div class="table-responsive">
  <table class="table table-hover" id="myTable">
    <thead>
      <tr>
        <th>Copies</th>
        <th>Added On</th>
        <th>Added By</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql_query="SELECT a.copies,a.added_on,b.units,c.firstname,c.lastname FROM jo_copies a LEFT JOIN joc_units b ON a.units=b.id LEFT JOIN users_list c ON a.added_by=c.id WHERE a.job_no=".$_GET['copies']." ORDER BY a.added_on DESC";
        $total = 0;
        $result_set=mysqli_query($conn,$sql_query);
        if(mysqli_num_rows($result_set)>0){
          while($row=mysqli_fetch_assoc($result_set)){
          ?>  
          <tr> 
            <td><?php echo $row['copies']." ".$row['units'];?></td>
            <td><?php echo date('F d, Y',strtotime($row['added_on']));?></td>
            <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
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