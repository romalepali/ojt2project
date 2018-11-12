<?php
	$_SESSION['page'] = "reports.php?reports=suggestions";
?>
<title>System Reports | Suggestions</title>
<ul id="tabsJustified" class="nav nav-tabs">
	<li class="nav-item">
		<a href="reports.php?reports=all" class="nav-link small text-uppercase">
			All
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($count_result)>0){
					while($count=mysqli_fetch_assoc($count_result)){
						echo $count['ucount'];
					}
				}?>
			</span>
		</a>
	</li><?php
	$sr_query = "SELECT * FROM system_reports_type ORDER BY type ASC";
	$sr_result=mysqli_query($conn,$sr_query);
	if(mysqli_num_rows($sr_result)>0){
		while($sr=mysqli_fetch_assoc($sr_result)){
			if($sr['id']==1){?>
				<li class="nav-item">
					<a href="reports.php?reports=bugs" class="nav-link small text-uppercase">
						<?php echo $sr['type'];?>
						<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
							if(mysqli_num_rows($countb_result)>0){
								while($countb=mysqli_fetch_assoc($countb_result)){
									echo $countb['ucount'];
								}
							}?>
						</span>
					</a>
				</li><?php
			}else if($sr['id']==2){?>
				<li class="nav-item">
					<a href="reports.php?reports=suggestions" class="nav-link small text-uppercase active">
						<?php echo $sr['type'];?>
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
						<th>Sent By</th>
						<th>Message</th>
						<th>Sent On</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
			<tbody><?php
				$sr_query="SELECT a.id,a.message,a.sent_on,a.status,b.type,c.firstname,c.lastname FROM system_reports a LEFT JOIN system_reports_type b ON a.report_type=b.id LEFT JOIN users_list c ON a.sent_by=c.id WHERE b.id=2 ORDER BY a.sent_on DESC";
				$sr_result=mysqli_query($conn,$sr_query);
					if(mysqli_num_rows($sr_result)>0){
						while($sr=mysqli_fetch_assoc($sr_result)){?>  
							<tr> 
								<td><?php echo $sr['firstname']." ".$sr['lastname'];?></td>
								<td><?php echo $sr['message'];?></td>
								<td>
									<?php echo date('F d, Y h:i A',strtotime($sr['sent_on']));?>
								</td>
								<td><?php
									if($sr['status']=='New'){?>
										<span class="badge badge-danger text-uppercase"><?php
											echo $sr['status'];?>
										</span><?php
									}else if($sr['status']=='On-Going'){?>
										<span class="badge badge-secondary text-uppercase"><?php
											echo $sr['status'];?>
										</span><?php										
									}else if($sr['status']=='Done'){?>
										<span class="badge badge-success text-uppercase"><?php
											echo $sr['status'];?>
										</span><?php										
									}?>
									</span>
								</td>
								<td>
									<div style="margin: -10px 0px; ">
										<button class="btn btn-secondary" onclick="update_r('<?php echo $sr['id'];?>')" style="font-size: 12px; margin-top: 2px; ">
											UPDATE
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