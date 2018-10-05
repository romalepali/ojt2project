<?php
	$_SESSION['page']='job_inputs.php?input=status';
?>
<title>Job Inputs | Status</title>
<ul id="tabsJustified" class="nav nav-tabs">
	<li class="nav-item">
		<a href="job_inputs.php?input=colors" class="nav-link small text-uppercase">
			Colors
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($ccount_result)>0){
					while($ccount=mysqli_fetch_assoc($ccount_result)){
						echo $ccount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=job_kind" class="nav-link small text-uppercase">
			Job Kind
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($jkcount_result)>0){
					while($jkcount=mysqli_fetch_assoc($jkcount_result)){
						echo $jkcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=job_type" class="nav-link small text-uppercase">
			Job Type
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($jtcount_result)>0){
					while($jtcount=mysqli_fetch_assoc($jtcount_result)){
						echo $jtcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=materials" class="nav-link small text-uppercase">
			Materials
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($mcount_result)>0){
					while($mcount=mysqli_fetch_assoc($mcount_result)){
						echo $mcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=paper_size" class="nav-link small text-uppercase">
			Paper Size
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($pscount_result)>0){
					while($pscount=mysqli_fetch_assoc($pscount_result)){
						echo $pscount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=payments" class="nav-link small text-uppercase">
			Payments
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($ptcount_result)>0){
					while($ptcount=mysqli_fetch_assoc($ptcount_result)){
						echo $ptcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=printing" class="nav-link small text-uppercase">
			Printing
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($prcount_result)>0){
					while($prcount=mysqli_fetch_assoc($prcount_result)){
						echo $prcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=status" class="nav-link small text-uppercase active">
			Status
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($stcount_result)>0){
					while($stcount=mysqli_fetch_assoc($stcount_result)){
						echo $stcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=units" class="nav-link small text-uppercase">
			Units
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($ucount_result)>0){
					while($ucount=mysqli_fetch_assoc($ucount_result)){
						echo $ucount['count'];
					}
				}?>
			</span>
		</a>
	</li>
</ul>

<div id="tabsJustifiedContent" class="tab-content">
	<div id="all_jobs" class="tab-pane fade active show">
		<div>
			<button class="btn btn-secondary" onclick="add('true')" style="font-size: 12px; float: right; margin: 5px 0px 5px 5px;">
				ADD NEW
			</button>
		</div>
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>Status</th>
						<th>Updated By</th>
						<th>Updated On</th>
						<th>Actions</th>
					</tr>
				</thead>
		
				<tbody><?php
					$sql_query="SELECT a.*,b.firstname AS 'fn',b.lastname AS 'ln' FROM jos_list a LEFT JOIN users_list b ON a.updated_by=b.id ORDER BY a.status ASC";
					$result_set=mysqli_query($conn,$sql_query);
					if(mysqli_num_rows($result_set)>0){
						while($row=mysqli_fetch_assoc($result_set)){?>  
							<tr> 
								<td><?php echo $row['status'];?></td>
								<td><?php echo $row['fn']." ".$row['ln'];?></td>
								<td><?php echo date('F d, Y h:s A',strtotime($row['updated_on']));?></td>
								<td>
									<div style="margin: -10px 0px; ">
										<button class="btn btn-secondary" onclick="edit('<?php echo $row['id']; ?>')" style="font-size: 12px; margin-top: 2px;">
										EDIT
										</button> 
										<button class="btn btn-secondary" onclick="remove('<?php echo $row['id']; ?>')" style="font-size: 12px; margin-top: 2px;" disabled>
											REMOVE
										</button>
									</div>
								</td>
							</tr><?php
						}   
					}else{?>
						<tr>
							<td colspan="4" style="text-align: center;">No status yet!</td>
						</tr><?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="js/system/ji_status.js"></script>