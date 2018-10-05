<?php
	include ('TIMS_verify.php');
	$_SESSION['page']='small_jobs.php';

	$counts_query="SELECT count(*) AS 'ucount' FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind=b.id left JOIN jobbings_type c ON b.type=c.id WHERE c.id=2";
	$counts_result=mysqli_query($conn,$counts_query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>TIMS | Job Orders</title>
</head>

<style type="text/css">
	.nav-job-orders {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}

	thead,tbody {
		font-size: 15px;
	}
</style>

<body>
	<?php include ('include/navbar.php'); ?>
	<div class="gap2"></div>
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-md-12">
				<?php if(
					(isset($_GET['view']) || !isset($_GET['edit']) && !isset($_GET['update']) && !isset($_GET['add']) && !isset($_GET['more'])) && 
					(!isset($_GET['view']) || !isset($_GET['edit']) && !isset($_GET['update']) && !isset($_GET['add']) && isset($_GET['more'])) && 
					(!isset($_GET['view']) || !isset($_GET['edit']) && !isset($_GET['update']) && isset($_GET['add']) && !isset($_GET['more'])) && 
					(!isset($_GET['view']) || !isset($_GET['edit']) && isset($_GET['update']) && !isset($_GET['add']) && !isset($_GET['more'])) && 
					(!isset($_GET['view']) || isset($_GET['edit']) && !isset($_GET['update']) && !isset($_GET['add']) && !isset($_GET['more']))
				) {?>
					<ul id="tabsJustified" class="nav nav-tabs" id="tabs">
					<li class="nav-item">
						<a href="small_jobs.php" class="nav-link small text-uppercase active">
							Small Jobs
							<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
							<?php
							if(mysqli_num_rows($counts_result)>0)
							{
								while($counts=mysqli_fetch_assoc($counts_result))
								{
									echo $counts['ucount'];
								}
							}
							?>
							</span>
						</a>
					</li>
					<li class="nav-item"><a href="search.php" class="nav-link small text-uppercase">Search</a></li>
				</ul>
					<div id="tabsJustifiedContent" class="tab-content">
						<div id="all_jobs" class="tab-pane fade active show">
							<div>
								<a class="btn btn-secondary" href="javascript: add('small')" title="Add New" style="font-size: 12px; float: right; margin: 5px 0px 5px 5px;"><img src="images/new.png" width="12px" style="margin: -3px -3px 0px -3px;"></a>
							</div>
							<div class="table-responsive" style="max-height: 70vh;">
								<table class="table table-hover" id="myTable">
									<thead>
										<tr>
											<th onclick="sortTable(0)" class="tableSort">J.O. No.</th>
											<th onclick="sortTable(1)" class="tableSort">Type</th>
											<th onclick="sortTable(2)" class="tableSort">Kind of Job</th>
											<th onclick="sortTable(3)" class="tableSort">Date Received</th>
											<th onclick="sortTable(4)" class="tableSort">Due Date</th>
											<th onclick="sortTable(5)" class="tableSort">Agent</th>
											<th onclick="sortTable(6)" class="tableSort">Customer</th>
											<th onclick="sortTable(7)" class="tableSort">Artist</th>
											<th onclick="sortTable(8)" class="tableSort">Status</th>
											<th onclick="sortTable(9)" class="tableSort">Notes</th>
											<th onclick="sortTable(10)" class="tableSort">Date Added</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$sql_query="SELECT a.id AS 'id', a.job_no AS 'jon',a.description AS 'des',a.date_received,a.due_date,a.agent,a.customer,a.artist,a.date_added,a.current_note,b.kind_of_job AS 'koj',b.type,c.job_type AS 'jt',d.status_name AS 'sn' FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind=b.id RIGHT JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id WHERE b.type=2 ORDER BY a.date_added";
									$result_set=mysqli_query($conn,$sql_query);
									if(mysqli_num_rows($result_set)>0){
										while($row=mysqli_fetch_assoc($result_set)){
										?>  
											<tr> 
												<td><?php echo $row['jon'];?></td>
												<td><?php echo $row['jt'];?></td>
												<td><?php
														if($row['des']!=NULL){
															echo $row['koj']." (".$row['des'].")";
														}else{
															echo $row['koj'];
														}
													?></td>
													<td>
													<?php echo date('F d, Y',strtotime($row['date_received']));?>
													</td>
													<td><?php 
														if(round(((strtotime($row['due_date'])/24)/60)/60) == 0)
														{
															echo "Not set";
														}else{
															echo date('F d, Y',strtotime($row['due_date']));
														}?>
													</td>
													<td><?php
														if($row['agent']!=NULL){
															echo $row['agent'];
														}else{
															echo "N/A";
														}
													?></td>
													<td><?php echo $row['customer'];?></td>
													<td><?php
														if($row['artist']!=NULL){
															echo $row['artist'];
														}else{
															echo "N/A";
														}
													?></td>
												<td><?php echo $row['sn'];?></td>
												<td><?php
													if($row['current_note']!=NULL)
													{
														echo $row['current_note'];
													}
													else{
														echo "N/A";
													}?>
												</td>
												<td><?php echo date('F d, Y h:s A',strtotime($row['date_added']));?></td>
												<td><div style="margin: -10px 0px; "><button class="btn btn-secondary" onclick="view('<?php echo $row['id'];?>')" title="View Info" style="font-size: 12px; margin-top: 2px; "><img src="images/view.png" width="15px" style="margin: -3px -4px 0px -4px;"></button> <button class="btn btn-secondary" onclick="edit('<?php echo $row['id']; ?>')" title="Edit Info" style="font-size: 12px; margin-top: 2px;"><img src="images/edit.png" width="15px" style="margin: -3px -4px 0px -4px;"></button> <button class="btn btn-secondary" onclick="update('<?php echo $row['id']; ?>')" title="Update Status" style="font-size: 12px; margin-top: 2px;"><img src="images/update.png" width="15px" style="margin: -3px -4px 0px -4px;"></button> <button class="btn btn-secondary" onclick="more('<?php echo $row['id']; ?>')" title="View Previous Status" style="font-size: 12px; margin-top: 2px;"><img src="images/more.png" width="15px" style="margin: -3px -4px 0px -4px;"></button></div></td>
											</tr>
										<?php
										}   
									}
									else{
									?>
										<tr>
											<td colspan="12" style="text-align: center;">No data yet!</td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			<?php
			}else
			{	
			?>
				<ul id="tabsJustified" class="nav nav-tabs" id="tabs">
					<li class="nav-item">
						<a href="small_jobs.php" class="nav-link small text-uppercase">
							Small Jobs
							<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
							<?php
							if(mysqli_num_rows($counts_result)>0)
							{
								while($counts=mysqli_fetch_assoc($counts_result))
								{
									echo $counts['ucount'];
								}
							}
							?>
							</span>
						</a>
					</li>
					<li class="nav-item"><a href="search.php" class="nav-link small text-uppercase">Search</a></li>
				</ul>

				<?php
					if(isset($_GET['view'])){
	            		include ('job_orders/view_job_orders_small.php');
					} else if(isset($_GET['edit'])){
	            		include ('job_orders/edit_job_orders_small.php');
					} else if(isset($_GET['update'])){
	            		include ('job_orders/update_job_orders_small.php');
					} else if(isset($_GET['more'])){
	            		include ('job_orders/more_info_small.php');
					} else if(isset($_GET['add'])){
						include ('job_orders/add_job_orders_small.php');
					} 
				}
				?>
			</div>
		</div>
	</div>
	<script src="js/small_jobs_action.js"></script>
</body>
</html>