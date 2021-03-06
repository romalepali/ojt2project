<div class="table-responsive">
	<table class="table table-hover" id="myTable">
		<thead>
			<tr>
				<th>Status</th>
				<th>Notes</th>
				<th>Sample</th>
				<th>Correction</th>
				<th>Updated On</th>
				<th>Updated By</th>
			</tr>
		</thead>
		
		<tbody><?php
			$sql_query="SELECT a.notes,a.updated_on,a.sample,a.correction,b.status,c.firstname,c.lastname FROM jo_status a LEFT JOIN jos_list b ON a.status=b.id LEFT JOIN users_list c ON a.updated_by=c.id WHERE a.job_no=".$_GET['status']." ORDER BY a.updated_on DESC";
			$result_set=mysqli_query($conn,$sql_query);
			if(mysqli_num_rows($result_set)>0){
				while($row=mysqli_fetch_assoc($result_set)){?>  
					<tr> 
						<td><?php echo $row['status'];?></td>
						<td><?php if($row['notes']!=NULL){echo $row['notes'];}else{echo "N/A";}?></td>
						<td><?php 
							if($row['sample']!=NULL){?>
								<a href="../uploads/documents/sample/<?php echo $row['sample'];?>.pdf" target="_t">
									DOWNLOAD
								</a><?php
							}else{
								echo "N/A";
							}?>
						</td>
						<td><?php 
							if($row['correction']!=NULL){?>
								<a href="../uploads/documents/correction/<?php echo $row['correction'];?>.pdf" target="_t">
									DOWNLOAD
								</a><?php
							}else{
								echo "N/A";
							}?>
						</td>
						<td><?php echo date('F d, Y h:i A',strtotime($row['updated_on']));?></td>
						<td><?php echo $row['firstname']." ".$row['lastname'];?></td>
					</tr><?php
				}   
			}else{?>
				<tr>
					<td colspan="6" style="text-align: center;">No Data Yet!</td>
				</tr><?php
			}?>
		</tbody>
	</table>
</div>