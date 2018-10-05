<?php
	include ('TIMS_verify.php');

	$_SESSION["filter"] = "reports_recent";

?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>TIMS | Reports</title>
</head>

<style type="text/css">
	.nav-reports {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}

	th{
		font-size: 12px;
	}

	td{
		font-size: 10px;
	}
	.btn-secondary{
		background-color: #8B0000;
	}
	
</style>

<body>
	<?php include ('include/navbar.php'); ?>
	<div class="gap"></div>
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-md-12">

					<div id="search_clients" class="tab-pane fade active show">
		              <?php 
		            
		                include('reports/reports_Tab.php');

		                $month = date("m");
		                 $year = date("Y");
		                $curMonth= date('F', mktime(0, 0, 0, $month, 10));
		                $lastMonth= date('F', mktime(0, 0, 0, $month-1, 10));
		               ?>
		               <script>
							
						function filterTable(event) {
							
						    var filter = event.target.value.toUpperCase();
						    var rows = document.querySelector("#myTable tbody").rows;
						    
						    for (var i = 0; i < rows.length; i++) {
						        var firstCol = rows[i].cells[2].textContent.toUpperCase();
						        var secondCol = rows[i].cells[3].textContent.toUpperCase();
						        if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
						            rows[i].style.display = "";
						        } else {
						            rows[i].style.display = "none";
						        }      

						    }
						}

						document.querySelector('#search').addEventListener('keyup', filterTable, false);		

						</script>
	                </div>

					<ul id="tabsJustified" class="nav nav-tabs">
						<li class="nav-item"><a href="reports.php" class="nav-link small text-uppercase ">All </a></li>
						<li class="nav-item"><a href="reports_recent.php" class="nav-link small text-uppercase active">Recent</a></li>
						<li class="nav-item"><a href="reports_this_month.php" class="nav-link small text-uppercase"> This <?php echo $curMonth;?></a></li>
						<li class="nav-item"><a href="reports_last_month.php" class="nav-link small text-uppercase"> Last <?php echo $lastMonth;?></a></li>
						<li class="nav-item"><a href="reports_this_year.php" class="nav-link small text-uppercase">This <?php echo $year;?></a></li>
						<li class="nav-item"><a href="reports_last_year.php" class="nav-link small text-uppercase">Last <?php echo $year-1;?></a></li>
					</ul>


				<div id="tabsJustifiedContent" class="tab-content">
	         	<div id="all_jobs" class="tab-pane fade active show">
							<div class="table-responsive">
								<table class="table table-hover" id="myTable">
									<thead>
										<tr>
											<th onclick="sortTable(0)" class="tableSort">Date Recieved</th>
											<th onclick="sortTable(1)" class="tableSort">Agent</th>
											<th onclick="sortTable(2)" class="tableSort">J.O. No.</th>
											<th onclick="sortTable(4)" class="tableSort">Customer</th>
											<th onclick="sortTable(5)" class="tableSort">Type of Job</th>
											<th onclick="sortTable(5)" class="tableSort">Kind of Job</th>
											<th onclick="sortTable(6)" class="tableSort">Quantity</th>
											<th onclick="sortTable(7)" class="tableSort">Artist</th>
											<th onclick="sortTable(8)" class="tableSort">Pages</th>
											<th onclick="sortTable(3)" class="tableSort">Status</th>
											<th onclick="sortTable(10)" class="tableSort">Due date</th>
											<th onclick="sortTable(9)" class="tableSort">Notes</th>
										</tr>
									</thead>
									<tbody>

									<?php

									if(isset($_POST['submit'])){
										 
									 
				   					$emptyDisplay = 'No Data';
				   					 $andCount = $keyCount=0;

									 $sql_query="SELECT a.status_date,a.current_status,a.job_no AS 'jon',a.date_received,a.due_date,a.agent,a.customer,a.artist,a.pages,a.current_note,a.initial_copies, a.payment, b.kind_of_job AS 'koj',c.job_type AS 'jt',d.status_name AS 'sn',d.id FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind=b.id LEFT JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id WHERE ";
											
											if(!empty($_POST['artist'])){
												if($andCount==1){
													$sql_query .= " &&";
												}

												$artist = mysqli_real_escape_string($conn,$_POST['artist']);
												$sql_query .= " a.artist = ('$artist') ";
												$andCount = 1;
											}

											if(!empty($_POST['jobKind'])){
												if($andCount==1){
													$sql_query .= " &&";
												}

												 $jobKind = mysqli_real_escape_string($conn,$_POST['jobKind']);
												 $sql_query .= " b.id = ('$jobKind') ";
												$andCount = 1;
											}


											 if(!empty($_POST['agent'])){
											 	if($andCount==1){
													$sql_query .= " &&";
												}

												 $agent = mysqli_real_escape_string($conn,$_POST['agent']);
												 $sql_query .= " a.agent = ('$agent')";
												$andCount = 1;
											}

											if (empty($_POST['artist'])&&empty($_POST['Status'])&&empty($_POST['jobKind'])&&empty($_POST['jobType'])&&empty($_POST['agent'])&&empty($_POST['year'])&&empty($_POST['payment'])&&empty($_POST['month'])) {

												$sql_query="SELECT a.status_date,a.current_status,a.job_no AS 'jon',a.date_received,a.due_date,a.agent,a.customer,a.artist,a.pages,a.current_note,a.initial_copies,b.kind_of_job AS 'koj',c.job_type AS 'jt',d.status_name AS 'sn' FROM jobbings a INNER JOIN jobbings_kinds b ON a.job_kind=b.id INNER JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id WHERE b.type = 2 ORDER BY a.status_date DESC";

												$andCount=2;
											}

											 if($andCount!=2){

												if($andCount==1){
													$sql_query .= " &&";
												}

											 $sql_query .= " b.type = 2 ORDER BY a.status_date DESC ";

											
											}
										}

									else {

									$sql_query="SELECT a.status_date,a.current_status,a.job_no AS 'jon',a.date_received,a.due_date,a.agent,a.customer,a.artist,a.pages,a.current_note,a.initial_copies,b.kind_of_job AS 'koj',c.job_type AS 'jt',d.status_name AS 'sn' FROM jobbings a INNER JOIN jobbings_kinds b ON a.job_kind=b.id INNER JOIN jobbings_type c ON b.type=c.id LEFT JOIN jobbings_statuses d ON a.current_status=d.id WHERE b.type = 2 ORDER BY a.status_date DESC";
									$emptyDisplay = 'No Data';

								    }
									
									  $colorCode = $stat = $ddateDisplay = $headYear = $prevHeadYear = $headMonth = $prevHeadMonth = "" ;
									$date = date('Y-m-d');
									$colorCode= $deadline = "";

									$result_set=mysqli_query($conn,$sql_query);
									if(mysqli_num_rows($result_set)>0){
										while($row=mysqli_fetch_assoc($result_set)){

											//////////////////////////////////////////
											$headYear = date("Y", strtotime($row['status_date']));

											if($prevHeadYear!=$headYear){ ///////


													?>
													<tr height="20px">
				                                    	<th style="text-align:center; font-size: 25px; color: white; background: rgb(170,0,0); " colspan="12"><?php echo $headYear; ?></th>
				                                    </tr>
												<?php											

											}
												$prevHeadYear = $headYear;

											$headMonth = date("F", strtotime($row['status_date']));

											if($prevHeadMonth!=$headMonth){ ///////


													?>
													<tr height="20px">
				                                    	<th style="text-align:left; font-size: 20px; color: rgb(170,0,0);" colspan="12"><?php echo $headMonth; ?></th>
				                                    </tr>
												<?php

												
											}
												$prevHeadMonth = $headMonth;


											$ddate = strtotime($row['due_date']);
										    $cdate = strtotime($date);
									        $timeleft = $ddate - $cdate;
									        $days = round((($timeleft/24)/60)/60);
									        $stat = $row['current_status'];
									        $id ='';

									        	if ($stat==5){	//OUT 
									        		$colorCode = "table-success";

									        		if($ddate==0){
									        			$deadline = "Due date not set";
									        		}

									        		else{
									        			$deadline = $row['due_date'];
									        		}
									        	}

									        	else if($stat==7){
									        		$colorCode = "table-dark";

									        		if($ddate==0){
									        			$deadline = "Due date not set";
									        		}

									        		else{
									        			$deadline = $row['due_date'];
									        		}
									        	}

									        	else{

									        		if($ddate!=0){

											        	if($days >16){
											        		$colorCode = "table-light";
											        		$deadline = $row['due_date'];
											        	}

											        	else if ($days <=15 && $days > 10) {
											        		$colorCode = "table-warning";
											        		$deadline = "".$row['due_date']."<b style='color: darkorange;'>&nbsp; (".$days." day/s left)</em>";

											        	}

											        	else if ($days <=10 && $days >0) {
											        		$colorCode = "table-danger";
											        		$deadline = "".$row['due_date']."<b style='color: red;'>&nbsp; (".$days." day/s left)</b>";
											        	}

											        	else if ($days == 0) {
											        		$colorCode = "table-danger";
											        		$id = 'style="color: red;"';
											        		$deadline = "<b style='color: red;'>TODAY!</b>";
											        	}

											        	else if ($days <0){
											        		$colorCode = "table-active";
											        		$id = 'style="color: red;"';
											        		$deadline = "".$row['due_date']."<b style='color: darkred;'>&nbsp; (".abs($days)." day/s late)</b>";
											        	} 
										        	}

										        	else{
											        	$colorCode = "table-light";
											        	$deadline = "Due date not set!";
											        }
									       		}
											?>  
											<tr class="<?php echo $colorCode;?>" <?php echo $id;  ?> >  
												<td><?php echo $row['date_received'];?></td>	   
												<td><?php echo $row['agent'];?></td>
												<td><?php echo $row['jon'];?></td>
												<td><?php echo $row['customer'];?></td>
												<td><?php echo $row['jt'];?></td>
												<td><?php echo $row['koj'];?></td>
												<td><?php echo $row['initial_copies'];?></td>			
												<td><?php echo $row['artist'];?></td>
												<td><?php echo $row['pages'];?></td>	
												<td><?php echo $row['sn'];?></td>
												<td><?php echo $deadline;?></td>
												<td><?php echo $row['current_note'];?></td>
											</tr>
											<?php
										}   
									}
									else{
									?>
										<tr height="50px">
	                                    		<td align="center" colspan="11"><?php echo $emptyDisplay; ?></td>
	                                    	</tr>
										<?php
										}

										?>
									</tbody>
							</div>
				</div>
				</div>
							
				</div>
			</div>
		</div>
    </div>
</body>
</html>