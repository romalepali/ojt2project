<?php
	include ('TIMS_verify.php');
	$_SESSION["filter"] = "clients_big_jobs";
	$_SESSION['page']='clients_big_jobs_small.php';
	if(isset($_POST['submit'])){
		$search = mysqli_real_escape_string($conn,$_POST['search']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>TIMS | Big Job Clients</title>
</head>

<style type="text/css">
	.nav-clients {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}

		thead,tbody {
		font-size: 11px;
	}
</style>

<body>
	<?php include ('include/navbar.php'); ?>
	<div class="gap2"></div>
	<div class="container-fluid" >
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
					<ul id="tabsJustified" class="nav nav-tabs">
						<li class="nav-item"><a href="clients.php" class="nav-link small text-uppercase ">All</a></li>
						<li class="nav-item"> <a href="clients_small_jobs.php"  class="nav-link small text-uppercase">Small Jobs</a></li>
						<li class="nav-item"><a href="clients_big_jobs.php" class="nav-link small text-uppercase">Big Jobs</a></li>
						<li class="nav-item"><a href="clients_big_jobs_small.php" class="nav-link small text-uppercase active">Big Jobs (Small)</a></li>
					</ul>
					<div id="search_clients" class="tab-pane fade active show">
						<?php include('clients/search_clients.php');?>
					</div>
					<div id="tabsJustifiedContent" class="tab-content" style="margin-top: -10px;">
						<div id="home1" class="tab-pane fade active show">
							<div class="table-responsive">
								<table class="table table-hover" id="dataTable"><?php
									$emptyDisplay = 'No Clients As Of Now';	  
									$sql_query="SELECT  jobbings.customer FROM jobbings LEFT JOIN jobbings_kinds ON jobbings.job_kind = jobbings_kinds.id WHERE jobbings_kinds.type =3 ORDER BY jobbings.customer ASC";
									$result_set = mysqli_query($conn,$sql_query);
									$last = $customer =  $ifExist ='';  $counterRow = 0;    
									if(mysqli_num_rows($result_set)>0){
										while ($row = mysqli_fetch_array($result_set)){
											$customer = $row['customer'];
											$current =  strtolower($row['customer'][0]);
											if ($last != $current){?>
												<thead>
													<tr>
														<th>
															<h5 style="margin: 0px;">
																<b style="color:#8B0000">
																	<?php echo strtoupper($current)?>
																</b>
															</h5>
														</th>
													</tr>
												</thead><?php
												$last = $current;
											}
											if($customer!=$ifExist){ 
												$customer = $row['customer'];?>
												<tbody>     
													<tr class="customer" data-toggle="collapse" id="<?php echo $counterRow;?>" data-target=".<?php echo $counterRow;?>collapsed">
														<td>
															<b>
																<?php echo $customer;?>
															</b>
														</td>
													</tr><?php 
													$query = " SELECT  a.id, a.job_no FROM jobbings a LEFT JOIN jobbings_kinds b ON a.job_kind = b.id WHERE customer = ('$customer') AND type =3 ORDER BY a.job_no ASC ";
													$result = mysqli_query($conn,$query);    
													if(mysqli_num_rows($result)>0){
														while ($row1 = mysqli_fetch_array($result)){?>
															<tr class="collapse out budgets <?php echo $counterRow;?>collapsed">
																<td>
																	<button class="btn btn-link" style="font-size: 12px;" onclick="view('<?php echo $row1['id'];?>')">J.O. #  <?php echo $row1['job_no'];?></button>
																</td>
															</tr><?php
														}
													}
													else{?>
														<tr class="collapse out budgets <?php echo $counterRow;?>collapsed">
															<td>No Orders</td>
														</tr><?php
													}
												}
												$counterRow++;
												$ifExist = $customer;
											}   
										} 
										else{?>
											<tr height="50px">
												<td align="center" colspan="3">No Data</td>
											</tr><?php
										}?>
									</tbody>
								</table>
							</div>
						</div>					 
					</div>
					<?php } else {?>
						<ul id="tabsJustified" class="nav nav-tabs">
							<li class="nav-item"><a href="clients.php" class="nav-link small text-uppercase">All</a></li>
							<li class="nav-item"> <a href="clients_small_jobs.php"  class="nav-link small text-uppercase">Small Jobs</a></li>
							<li class="nav-item"><a href="clients_big_jobs.php" class="nav-link small text-uppercase">Big Jobs</a></li>
							<li class="nav-item"><a href="clients_big_jobs_small.php" class="nav-link small text-uppercase">Big Jobs (Small)</a></li>
						</ul>
						<?php
						if(isset($_GET['view'])){
		            		include ('job_orders/view_job_orders_big_small.php');
						} else if(isset($_GET['more'])){
		            		include ('job_orders/more_info_big_small.php');
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/clients_big_small.js"></script>
	<script>
		function myFunction() {
			var input, filter, table, tr, td, i;
			input = document.getElementById("search");
			filter = input.value.toUpperCase();
			table = document.getElementById("dataTable");
			tr = table.getElementsByClassName("customer");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (td) {
					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				} 
			}
		}
	</script>
</body>
</html>