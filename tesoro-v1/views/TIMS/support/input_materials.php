<?php
	include ('TIMS_verify.php');
	$_SESSION['page']='input_materials.php';

	$count_query="SELECT count(*) AS 'ucount' FROM printing_materials";
	$count_result=mysqli_query($conn,$count_query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inputs | Materials</title>
	<?php include ('include/head.php')?>
</head>

<style type="text/css">
	.nav-materials {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}

	thead,tbody {
		font-size: 15px;
	}
</style>

<body>
	<?php include ('include/navbar.php')?>
	<div class="gap2"></div>
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-lg-12">
				<?php if(
					(isset($_GET['edit']) || !isset($_GET['add']) && !isset($_GET['add']) && !isset($_GET['remove'])) && 
					(!isset($_GET['edit']) || !isset($_GET['add']) && !isset($_GET['add']) && isset($_GET['remove'])) && 
					(!isset($_GET['edit']) || !isset($_GET['add']) && isset($_GET['add']) && !isset($_GET['remove'])) && 
					(!isset($_GET['edit']) || isset($_GET['add']) && !isset($_GET['add']) && !isset($_GET['remove']))
				) {?>
					<ul id="tabsJustified" class="nav nav-tabs">
						<li class="nav-item">
							<a href="input_materials.php" class="nav-link small text-uppercase active">
								All Materials
								<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
								<?php
                                    if(mysqli_num_rows($count_result)>0)
                                    {
                                        while($count=mysqli_fetch_assoc($count_result))
                                        {
                                            echo $count['ucount'];
                                        }
                                    }
								?>
								</span>
							</a>
						</li>
					</ul>
					<div id="tabsJustifiedContent" class="tab-content">
						<div id="all_jobs" class="tab-pane fade active show">
							<div>
								<button class="btn btn-secondary" onclick="add('true')" title="Add New" style="font-size: 12px; float: right; margin: 5px 0px 5px 5px;"><img src="images/new.png" width="12px" style="margin: -3px -3px 0px -3px;"></button>
							</div>
							<div class="table-responsive" style="max-height: 70vh;">
								<table class="table table-hover" id="myTable">
									<thead>
										<tr>
											<th onclick="sortTable(0)" class="tableSort">Material</th>
											<th onclick="sortTable(1)" class="tableSort">Added By</th>
											<th onclick="sortTable(2)" class="tableSort">Date Modified</th>
											<th>Actions</th>
										</tr>
									</thead>
		
									<tbody>
									<?php
									$sql_query="SELECT a.*,b.firstname AS 'fn',b.lastname AS 'ln' FROM printing_materials a LEFT JOIN users b ON a.added_by=b.id ORDER BY materials ASC";
									$result_set=mysqli_query($conn,$sql_query);
									if(mysqli_num_rows($result_set)>0){
										while($row=mysqli_fetch_assoc($result_set)){
										?>  
											<tr> 
												<td><?php echo $row['materials'];?></td>
												<td><?php echo $row['fn']." ".$row['ln'];?></td>
												<td><?php echo date('F d, Y h:s A',strtotime($row['date_modified']));?></td>
												<td>
													<div style="margin: -10px 0px; ">
														<button class="btn btn-secondary" onclick="edit('<?php echo $row['id']; ?>')" title="Edit Info" style="font-size: 12px; margin-top: 2px;">
															<img src="images/edit.png" width="15px" style="margin: -3px -4px 0px -4px;">
														</button> 
														<button class="btn btn-secondary" onclick="remove('<?php echo $row['id']; ?>')" title="Remove Jobbing" style="font-size: 12px; margin-top: 2px;">
															<img src="images/delete.png" width="15px" style="margin: -3px -4px 0px -4px;">
														</button>
													</div>
												</td>
											</tr>
										<?php
										}   
									}
									else{
									?>
										<tr>
											<td colspan="4" style="text-align: center;">No materials yet!</td>
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
						<a href="input_materials.php" class="nav-link small text-uppercase">
							All Materials
							<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
								<?php
                                    if(mysqli_num_rows($count_result)>0)
                                    {
                                        while($count=mysqli_fetch_assoc($count_result))
                                        {
                                            echo $count['ucount'];
                                        }
                                    }
								?>
								</span>
						</a>
					</li>
				</ul>
			<?php
				if(isset($_GET['edit'])){
					include ('materials/edit_materials.php');
				} else if(isset($_GET['add'])){
					include ('materials/add_materials.php');
				} else if(isset($_GET['remove'])){
					include ('materials/remove_materials.php');
				} 
			}
			?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/materials.js"></script>
	<script src="js/view_jobs.js"></script>
</body>
</html>