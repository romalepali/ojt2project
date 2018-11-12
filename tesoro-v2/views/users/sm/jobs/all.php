<?php
	$_SESSION['page']='all_jobs.php?jobs=all';
?>
<title>Job Orders | All Jobs</title>
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
	</li><?php
	$jt_query = "SELECT * FROM jo_type ORDER BY job_type ASC";
	$jt_result=mysqli_query($conn,$jt_query);
	if(mysqli_num_rows($jt_result)>0){
		while($jt=mysqli_fetch_assoc($jt_result)){
			if($jt['id']==1){?>
				<li class="nav-item">
					<a href="all_jobs.php?jobs=big" class="nav-link small text-uppercase">
						<?php echo $jt['job_type']." Jobs";?>
						<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
							if(mysqli_num_rows($countb_result)>0){
								while($countb=mysqli_fetch_assoc($countb_result)){
									echo $countb['ucount'];
								}
							}?>
						</span>
					</a>
				</li><?php
			}else if($jt['id']==3){?>
				<li class="nav-item">
					<a href="all_jobs.php?jobs=bigsmall" class="nav-link small text-uppercase">
						<?php echo $jt['job_type']." Jobs";?>
						<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
							if(mysqli_num_rows($countbs_result)>0){
								while($countbs=mysqli_fetch_assoc($countbs_result)){
									echo $countbs['ucount'];
								}
							}?>
						</span>
					</a>
				</li><?php
			}else if($jt['id']==2){?>
				<li class="nav-item">
					<a href="all_jobs.php?jobs=small" class="nav-link small text-uppercase">
						<?php echo $jt['job_type']." Jobs";?>
						<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
							if(mysqli_num_rows($counts_result)>0){
								while($counts=mysqli_fetch_assoc($counts_result)){
									echo $counts['ucount'];
								}
							}?>
						</span>
					</a>
				</li><?php
			}
		}
	}?>
</ul>

<div id="tabsJustifiedContent" class="tab-content">
	<div id="all_jobs" class="tab-pane fade active show">
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>J.O. No.</th>
						<th>Job Kind</th>
						<th>Customer</th>
						<th>Received On</th>
						<th>Deadline On</th>
						<th>Curent Status</th>
						<th>Updated By</th>
						<th>Updated On</th>
						<th>Actions</th>
					</tr>
				</thead>
			<tbody><?php
				$jo_query="SELECT a.job_no,a.description,a.customer,a.pages,a.received_on,a.deadline_on,b.job_kind FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id ORDER BY a.encoded_on DESC";
				$jo_result=mysqli_query($conn,$jo_query);
					if(mysqli_num_rows($jo_result)>0){
						while($jo=mysqli_fetch_assoc($jo_result)){?>  
							<tr> 
								<td><?php echo $jo['job_no'];?></td>								<td><?php
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
										<td><?php echo date('F d, Y h:i A',strtotime($status['updated_on']));?></td><?php
									}
								}else{?>
									<td><?php
										echo "N/A";?>
									</td>
									<td><?php
										echo "N/A";?>
									</td>
									<td><?php
										echo "N/A";?>
									</td><?php
								}?>

								<td>
									<div style="margin: -10px 0px; ">
										<button class="btn btn-secondary" onclick="view('<?php echo $jo['job_no'];?>')" style="font-size: 12px; margin-top: 2px; ">
											MORE INFO
										</button>
										<button class="btn btn-secondary" onclick="remove('<?php echo $jo['job_no']; ?>')" style="font-size: 12px; margin-top: 2px;" disabled>
											REMOVE
										</button>
									</div>
								</td>
							</tr><?php
						}   
					}
					else{?>
						<tr>
							<td colspan="9" style="text-align: center;">No Data Yet!</td>
						</tr><?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>