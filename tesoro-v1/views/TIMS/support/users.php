<?php
	include ('TIMS_verify.php');
	$_SESSION['page']='users.php';
	$count_query="SELECT count(status) AS 'ucount' FROM users WHERE type!=1";
	$count_result=mysqli_query($conn,$count_query);

	$active_query="SELECT count(status) AS 'ucount' FROM users WHERE (type!=1 && status='Active')";
	$active_result=mysqli_query($conn,$active_query);

	$inactive_query="SELECT count(status) AS 'ucount' FROM users WHERE (type!=1 && status='Inactive')";
	$inactive_result=mysqli_query($conn,$inactive_query);

	$users_query="SELECT * FROM users_privileges WHERE id!=1";
	$users_result=mysqli_query($conn,$users_query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>TIMS | Users</title>
</head>

<style type="text/css">
	.nav-users {
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
					(isset($_GET['update']) || !isset($_GET['remove'])) && 
					(!isset($_GET['update']) || isset($_GET['remove']))
				) {?>
					<ul id="tabsJustified" class="nav nav-tabs">
						<li class="nav-item">
							<a href="users.php" class="nav-link small text-uppercase active">
								All
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
						<li class="nav-item">
							<a href="users_ac.php" class="nav-link small text-uppercase">
								Active
								<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
								<?php
	                                if(mysqli_num_rows($active_result)>0)
	                                {
	                                    while($active=mysqli_fetch_assoc($active_result))
	                                    {
	                                        echo $active['ucount'];
	                                    }
	                                }
								?>
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="users_iac.php" class="nav-link small text-uppercase">
								Inactive
								<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
								<?php
	                                if(mysqli_num_rows($inactive_result)>0)
	                                {
	                                    while($inactive=mysqli_fetch_assoc($inactive_result))
	                                    {
	                                        echo $inactive['ucount'];
	                                    }
	                                }
								?>
								</span>
							</a>
						</li>
					</ul>
					<div id="tabsJustifiedContent" class="tab-content">
						<div id="all_jobs" class="tab-pane fade active show">
							<div class="table-responsive" style="max-height: 70vh;">
								<table class="table table-hover" id="myTable">
									<thead>
										<tr>
											<th class="tableSort">Picture</th>
											<th onclick="sortTable(1)" class="tableSort">User Type</th>
											<th onclick="sortTable(2)" class="tableSort">Status</th>
											<th onclick="sortTable(3)" class="tableSort">Name</th>
											<th onclick="sortTable(4)" class="tableSort">Email</th>
											<th onclick="sortTable(5)" class="tableSort">Birthdate</th>
											<th onclick="sortTable(6)" class="tableSort">Gender</th>
											<th onclick="sortTable(7)" class="tableSort">Date Added</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$sql_query="SELECT a.*,b.name FROM users a LEFT JOIN users_privileges b ON a.type=b.id WHERE a.type!=1 ORDER BY a.id";
									$result_set=mysqli_query($conn,$sql_query);
									if(mysqli_num_rows($result_set)>0){
										while($row=mysqli_fetch_assoc($result_set)){?>
											<tr>
												<td><img style="border-radius: 100px" width="40px" src="../users/images/<?php if($row['picture']=='default'){echo $row['picture'].'2.png';}else{echo $row['picture'].'.png';}?>"></td>
												<td><?php if($row['type']!=0){echo $row['name'];}else{echo "N/A";}?></td>
												<td><?php echo $row['status'];?></td>
												<td><?php echo $row['lastname'].", ".$row['firstname']." ".$row['middlename'];?></td>
												<td><?php echo $row['email'];?></td>
												<td><?php echo date('F d, Y',strtotime($row['birthdate']));?></td>
												<td><?php echo $row['gender'];?></td>
												<td><?php echo date('F d, Y h:m A',strtotime($row['date_added']));?></td>
												<td>
													<div style="margin: -10px 0px; ">
														<button class="btn btn-secondary" onclick="update('<?php echo $row['id']; ?>')" title="Update User" style="font-size: 12px; margin-top: 2px;">
															<img src="images/update.png" width="15px" style="margin: -3px -4px 0px -4px;">
														</button> 
														<button class="btn btn-secondary" onclick="remove('<?php echo $row['id']; ?>')" title="Remove User" style="font-size: 12px; margin-top: 2px;">
															<img src="images/delete.png" width="15px" style="margin: -3px -4px 0px -4px;">
														</a>
													</div>
												</td>
											</tr>
										<?php
										}   
									}
									else{
									?>
										<tr>
											<td colspan="9" style="text-align: center;">No users yet!</td>
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
							<a href="users.php" class="nav-link small text-uppercase">
								All
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
						<li class="nav-item">
							<a href="users_ac.php" class="nav-link small text-uppercase">
								Active
								<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
								<?php
	                                if(mysqli_num_rows($active_result)>0)
	                                {
	                                    while($active=mysqli_fetch_assoc($active_result))
	                                    {
	                                        echo $active['ucount'];
	                                    }
	                                }
								?>
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="users_iac.php" class="nav-link small text-uppercase">
								Inactive
								<span class="float-right badge badge-pill badge-danger" style="margin-left:10px">
								<?php
	                                if(mysqli_num_rows($inactive_result)>0)
	                                {
	                                    while($inactive=mysqli_fetch_assoc($inactive_result))
	                                    {
	                                        echo $inactive['ucount'];
	                                    }
	                                }
								?>
								</span>
							</a>
						</li>
				</ul>
			<?php
				if(isset($_GET['update'])){
            		include ('users/update_user.php');
				} else if(isset($_GET['remove'])){
					include ('users/remove_user.php');
				}
			}
			?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="choose">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add New User</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="row"><?php
						if(mysqli_num_rows($users_result)>0){
							while($users=mysqli_fetch_assoc($users_result)){?>
								<div class="col">
									<button class="btn btn-secondary form-control" style="margin: 5px;" title="<?php echo $users['description'];?>" onclick="add('<?php echo $users['id'];?>')"><?php echo $users['name'];?></a>
								</div><?php
							}
						}?>
					</div>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="js/users_action.js"></script>
	<script src="js/view_jobs.js"></script>
</body>
</html>