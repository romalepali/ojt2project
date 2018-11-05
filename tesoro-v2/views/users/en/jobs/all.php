<?php
	$_SESSION['page']='all_jobs.php?jobs=all';
?>
<title>Manage | Job Orders</title>
<ul id="tabsJustified" class="nav nav-tabs">
	<li class="nav-item">
		<a href="all_jobs.php?jobs=all" class="nav-link small text-uppercase active">
			All Jobs
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($count_result)>0){
					while($count=mysqli_fetch_assoc($count_result)){
						echo $count['ucount'];
					}
				}?>
			</span>
		</a>
	</li>
</ul>

<div id="tabsJustifiedContent" class="tab-content">
	<div id="all_jobs" class="tab-pane fade active show">
		<div>
			<a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#choose" style="font-size: 12px; float: right; margin: 5px 0px 5px 5px;">
				ADD NEW
			</a>
		</div>
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>J.O. No.</th>
						<th>Job Kind</th>
						<th>Customer</th>
						<th>Received On</th>
						<th>Agent</th>
						<th>Encoded On</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody><?php
					$sql_query="SELECT a.job_no,a.description,a.customer,a.pages,a.received_on,a.deadline_on,a.encoded_on,b.job_kind,c.firstname,c.lastname FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN users_list c ON a.agent=c.id ORDER BY a.encoded_on DESC";
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
								<td>
									<?php echo date('F d, Y',strtotime($jo['received_on']));?>
								</td>
								<td><?php echo $jo['firstname']." ".$jo['lastname'];?></td>
								<td>
									<?php echo date('F d, Y h:s A',strtotime($jo['encoded_on']));?>
								</td>
								<td>
									<div style="margin: -10px 0px; ">
										<button class="btn btn-secondary" onclick="view('<?php echo $jo['job_no'];?>')" style="font-size: 12px; margin-top: 2px; ">
											MORE INFO
										</button> 
										<button class="btn btn-secondary" onclick="edit('<?php echo $jo['job_no']; ?>')" style="font-size: 12px; margin-top: 2px;">
											EDIT INFO
										</button> 
									</div>
								</td>
							</tr><?php
						}   
					}else{?>
						<tr>
							<td colspan="8" style="text-align: center;">
								No data yet!
							</td>
						</tr><?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>