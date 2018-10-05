<?php
	$countStat = 0;
?>
<style>
	.nav-uajo{
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}
</style>
<title>JOMIS | Unassigned</title>
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
						<th>Encoded On</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody><?php
					$sql_query="SELECT a.job_no,a.description,a.customer,a.pages,a.artist,a.deadline_on,a.encoded_on,b.job_kind,c.firstname AS 'arf',c.lastname AS 'arl',d.firstname AS 'crf',d.lastname AS 'crl' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN users_list c ON a.artist=c.id LEFT JOIN users_list d ON a.cover=d.id WHERE b.job_type!=2 ORDER BY a.encoded_on DESC";
					$result_set=mysqli_query($conn,$sql_query);
					if(mysqli_num_rows($result_set)>0){
						while($jo=mysqli_fetch_assoc($result_set)){?>  
							<tr><?php
								if($jo['artist']==NULL){?>
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
									</td>
									<td><?php echo date('F d, Y h:s A',strtotime($jo['encoded_on']));?></td>
									<td>
										<div style="margin: -10px 0px; ">
											<button class="btn btn-secondary" onclick="view('<?php echo $jo['job_no'];?>')" style="font-size: 12px; margin-top: 2px; ">
												MORE INFO
											</button> 
											<button class="btn btn-secondary" onclick="set_ar('<?php echo $jo['job_no']; ?>')" style="font-size: 12px; margin-top: 2px;">
												SET ARTIST
											</button>
										</div>
									</td><?php
									$countStat++;
								}?>
							</tr><?php
						}
						if($countStat==0){?>
							<td colspan="8" style="text-align: center;">
								No On-Going Job Orders Yet!
							</td><?php
						}
					}else{?>
						<tr>
							<td colspan="8" style="text-align: center;">
								No Unassigned Job Orders Yet!
							</td>
						</tr><?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>