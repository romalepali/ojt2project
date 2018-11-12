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
						<th>Assigned Artist</th>
						<th>Deadline On</th>
						<th>Current Status</th>
						<th>Notes</th>
						<th>Encoded On</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody><?php
					if(isset($_SESSION['search'])){
						$result_set=mysqli_query($conn,$query);
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
											if($jo['artist']!=NULL && $jo['artist']!=$_SESSION['user_id']){
												echo $jo['arf']." ".$jo['arl'];
											}else if($jo['artist']==NULL){
												echo "N/A";
											}else{
												echo "Me (".$jo['arf']." ".$jo['arl'].")";
											}?>
										</td>
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
											</button> <?php
											if($jo['deadline_on']==NULL){?>
												<button class="btn btn-secondary" onclick="update_deadline('<?php echo $jo['job_no']; ?>')" style="font-size: 12px; margin-top: 2px;">
													SET DEADLINE
												</button><?php
											}else{?>
												<button class="btn btn-secondary" onclick="update_deadline('<?php echo $jo['job_no']; ?>')" style="font-size: 12px; margin-top: 2px;">
													UPDATE DEADLINE
												</button><?php
											}?>
										</div>
									</td>
								</tr><?php
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