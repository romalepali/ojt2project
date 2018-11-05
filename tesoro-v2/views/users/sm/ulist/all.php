<?php
	$_SESSION['page']='users.php?users=all';
?>
<title>System Users | All</title>
<ul id="tabsJustified" class="nav nav-tabs">
	<li class="nav-item">
		<a href="users.php?users=all" class="nav-link small text-uppercase active">
			All
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($count_result)>0){
					while($count=mysqli_fetch_assoc($count_result)){
						echo $count['ucount'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="users.php?users=active" class="nav-link small text-uppercase">
			Active
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($active_result)>0){
					while($active=mysqli_fetch_assoc($active_result)){
						echo $active['ucount'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="users.php?users=inactive" class="nav-link small text-uppercase">
			Inactive
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($inactive_result)>0){
					while($inactive=mysqli_fetch_assoc($inactive_result)){
						echo $inactive['ucount'];
					}
				}?>
			</span>
		</a>
	</li>
</ul>

<div id="tabsJustifiedContent" class="tab-content">
	<div id="all_jobs" class="tab-pane fade active show">
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>Name</th>
						<th>User Type</th>
						<th>Status</th>
						<th>Date Added</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody><?php
					$sql_query="SELECT a.*,b.type AS 'utype' FROM users_list a LEFT JOIN users_type b ON a.type=b.id WHERE a.type!=2 ORDER BY a.id DESC";
					$result_set=mysqli_query($conn,$sql_query);
					if(mysqli_num_rows($result_set)>0){
						while($row=mysqli_fetch_assoc($result_set)){?>
							<tr>
								<td><a href="profile.php?profile_id=<?php echo $row['id'];?>"><?php echo $row['lastname'].", ".$row['firstname']." ".$row['middlename'];?></a></td>
								<td><?php if($row['type']!=0){echo $row['utype'];}else{echo "N/A";}?></td>
								<td><?php echo $row['status'];?></td>
								<td><?php echo date('F d, Y h:m A',strtotime($row['added_on']));?></td>
								<td>
									<div style="margin: -10px 0px; ">
										<button class="btn btn-secondary" onclick="update('<?php echo $row['id']; ?>')" style="font-size: 12px; margin-top: 2px;">
											UPDATE
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
							<td colspan="9" style="text-align: center;">No users yet!</td>
						</tr><?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>