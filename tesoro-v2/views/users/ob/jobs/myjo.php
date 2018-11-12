<style>
	.nav-myjo{
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}
</style>
<title>Job Orders | Handled</title>
<div id="tabsJustifiedContent" class="tab-content">
	<div id="all_jobs" class="tab-pane fade active show">
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>J.O. No.</th>
						<th>Job Kind</th>
						<th>Customer</th>
						<th>Deadline On</th>
						<th>Current Status</th>
						<th>My Notes</th>
						<th>Encoded On</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody><?php
					$sql_query="SELECT a.job_no,a.description,a.customer,a.pages,a.received_on,a.deadline_on,a.encoded_on,b.job_kind,c.firstname,c.lastname FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN users_list c ON a.agent=c.id WHERE a.artist=".$_SESSION['user_id']." ORDER BY a.encoded_on DESC";
					$result_set=mysqli_query($conn,$sql_query);
					if(mysqli_num_rows($result_set)>0){
						while($jo=mysqli_fetch_assoc($result_set)){?>  
							<tr> 
								<td><?php echo $jo['job_no'];?></td>
								<td><?php
									if($jo['description']!=NULL){
										echo $jo['job_kind']." (".$jo['description'].")";
									}else{
										echo $jo['job_kind'];
									}?>
								</td>
								<td><?php echo $jo['customer'];?></td>
								<td><?php
									if($jo['deadline_on']!=NULL){
										echo date('F d, Y',strtotime($jo['deadline_on']));
									}else{
										echo "N/A";
									}?>
								</td><?php
								$status_query="SELECT a.notes,a.updated_on,b.status FROM jo_status a INNER JOIN jos_list b ON a.status=b.id WHERE a.job_no=".$jo['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
								$status_result=mysqli_query($conn,$status_query);
								if(mysqli_num_rows($status_result)>0){
									while($status=mysqli_fetch_assoc($status_result)){?>
										<td><?php echo $status['status']." (".date('F d, Y h:i A',strtotime($status['updated_on'])).")";?></td>
										<td><?php
											if($status['notes']!=NULL){
												echo $status['notes'];
											}else{
												echo "N/A";
											}?>
										</td><?php
									}
								}else{?>
									<td>N/A</td>
									<td>N/A</td><?php
								}?>
								<td><?php echo date('F d, Y h:i A',strtotime($jo['encoded_on']));?></td>
								<td>
									<div style="margin: -10px 0px; ">
										<button class="btn btn-secondary" onclick="view('<?php echo $jo['job_no'];?>')" style="font-size: 12px; margin-top: 2px; ">
											MORE INFO
										</button> 
									</div>
								</td>
							</tr><?php
						}   
					}else{?>
						<tr>
							<td colspan="8" style="text-align: center;">No Job Orders Yet!</td>
						</tr><?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>