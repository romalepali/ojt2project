<title>Search Results</title>
<div id="tabsJustifiedContent" class="tab-content">
	<div id="search_jobs" class="tab-pane fade active show">
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>J.O. No.</th>
						<th>Job Kind</th>
						<th>Customer</th>
						<th>Received On</th>
						<th>Deadline On</th>
						<th>Status</th>
						<th>Updated By</th>
						<th>Updated On</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody><?php
					if(isset($_SESSION['search'])){
						$result_set=mysqli_query($conn,$query);
						if(mysqli_num_rows($result_set)>0){
							while($jo=mysqli_fetch_assoc($result_set)){
								if($jo['job_type']!=2){?>  
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
										<td>
											<?php echo date('F d, Y',strtotime($jo['received_on']));?>
										</td>
										<td><?php 
											if(round(((strtotime($jo['deadline_on'])/24)/60)/60) == 0){
												echo "N/A";
											}else{
												echo date('F d, Y',strtotime($jo['deadline_on']));
											}?>
										</td><?php
										$status_query="SELECT a.notes,a.updated_on,b.status,c.firstname,c.lastname FROM jo_status a INNER JOIN jos_list b ON a.status=b.id INNER JOIN users_list c ON a.updated_by=c.id WHERE a.job_no=".$jo['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
										$status_result=mysqli_query($conn,$status_query);
										if(mysqli_num_rows($status_result)>0){
											while($status=mysqli_fetch_assoc($status_result)){?>
												<td><?php
													if($status['notes']!=NULL){
														echo $status['status']." (".$status['notes'].")";
													}else{
														echo $status['status'];
													}?>
												</td>
												<td><?php echo $status['firstname']." ".$status['lastname'];?></td>
												<td><?php echo date('F d, Y',strtotime($status['updated_on']));?></td><?php
											}
										}else{?>
											<td><?php echo "N/A";?></td>
											<td><?php echo "N/A";?></td>
											<td><?php echo "N/A";?></td><?php
										}?>
										<td>
											<div style="margin: -10px 0px; ">
												<button class="btn btn-secondary" onclick="view('<?php echo $jo['job_no'];?>')" style="font-size: 12px; margin-top: 2px; ">
													MORE INFO
												</button> 
											</div>
										</td>
									</tr><?php
								}
							}   
						}else{?>
							<tr>
								<td colspan="12" style="text-align: center;">No results found!</td>
							</tr><?php
						}
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>