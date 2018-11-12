<?php
	$_SESSION['page']='search.php?search=jo';
?>
<title>Search Results</title>
<ul id="tabsJustified" class="nav nav-tabs">
	<li class="nav-item">
		<a href="search.php?search=jo" class="nav-link small text-uppercase active"><?php
			if($_SESSION['search']!=NULL){?>
				Search Results for <strong>"<?php echo $_SESSION['search'];?>"</strong><?php
			}else{?>
				Search Results<?php
			}?>
		</a>
	</li>
</ul>

<div id="tabsJustifiedContent" class="tab-content">
	<div id="search_jobs" class="tab-pane fade active show">
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
						<th>Encoded By</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody><?php
					if(isset($_SESSION['search'])){
						$result_set=mysqli_query($conn,$query);
						if(mysqli_num_rows($result_set)>0){
							while($jo=mysqli_fetch_assoc($result_set)){
								if($jo['agent']==$_SESSION['user_id']){?>  
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
										<td><?php echo $jo['afn']." ".$jo['aln'];?></td>
										<td>
											<?php echo date('F d, Y h:i A',strtotime($jo['encoded_on']));?>
										</td>
										<td><?php echo $jo['efn']." ".$jo['eln'];?></td>
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