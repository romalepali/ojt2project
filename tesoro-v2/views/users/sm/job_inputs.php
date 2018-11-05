<?php
	include ('config/sm_verify.php');

	$ccount_query="SELECT count(*) AS 'count' FROM jo_colors";
	$ccount_result=mysqli_query($conn,$ccount_query);

	$jkcount_query="SELECT count(*) AS 'count' FROM jo_kinds";
	$jkcount_result=mysqli_query($conn,$jkcount_query);

	$jtcount_query="SELECT count(*) AS 'count' FROM jo_type";
	$jtcount_result=mysqli_query($conn,$jtcount_query);

	$mcount_query="SELECT count(*) AS 'count' FROM jo_materials";
	$mcount_result=mysqli_query($conn,$mcount_query);

	$pscount_query="SELECT count(*) AS 'count' FROM jo_size";
	$pscount_result=mysqli_query($conn,$pscount_query);

	$ptcount_query="SELECT count(*) AS 'count' FROM jo_payments";
	$ptcount_result=mysqli_query($conn,$ptcount_query);

	$prcount_query="SELECT count(*) AS 'count' FROM jo_printing";
	$prcount_result=mysqli_query($conn,$prcount_query);

	$stcount_query="SELECT count(*) AS 'count' FROM jos_list";
	$stcount_result=mysqli_query($conn,$stcount_query);

	$ucount_query="SELECT count(*) AS 'count' FROM joc_units";
	$ucount_result=mysqli_query($conn,$ucount_query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
</head>

<style type="text/css">
	.nav-inputs {
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
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-md-12"><?php
					if(
					(isset($_GET['edit']) || !isset($_GET['add']) && !isset($_GET['add']) && !isset($_GET['remove'])) && 
					(!isset($_GET['edit']) || !isset($_GET['add']) && !isset($_GET['add']) && isset($_GET['remove'])) && 
					(!isset($_GET['edit']) || !isset($_GET['add']) && isset($_GET['add']) && !isset($_GET['remove'])) && 
					(!isset($_GET['edit']) || isset($_GET['add']) && !isset($_GET['add']) && !isset($_GET['remove']))
					) {?>
						<div style="margin-top: 50px;"><?php
							if(isset($_GET['input'])){
								if($_GET['input']=='colors'){
									include ('jinputs/colors.php');
								}else if($_GET['input']=='job_kind'){
									include ('jinputs/job_kind.php');
								}else if($_GET['input']=='job_type'){
									include ('jinputs/job_type.php');
								}else if($_GET['input']=='materials'){
									include ('jinputs/materials.php');
								}else if($_GET['input']=='paper_size'){
									include ('jinputs/paper_size.php');
								}else if($_GET['input']=='payments'){
									include ('jinputs/payments.php');
								}else if($_GET['input']=='printing'){
									include ('jinputs/printing.php');
								}else if($_GET['input']=='status'){
									include ('jinputs/status.php');
								}else if($_GET['input']=='units'){
									include ('jinputs/units.php');
								}
							}else{
								include ('jinputs/default.php');
							}?>
						</div><?php
					}else{?>
						<div style="margin-top: 50px;">
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
									<a href="job_inputs.php?input=status" class="nav-link small text-uppercase">
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
							</ul><?php
							if(isset($_GET['input'])){
								if($_GET['input']=='colors'){
									if(isset($_GET['edit'])){
										include ('operations/colors/edit_colors.php');
									} else if(isset($_GET['add'])){
										include ('operations/colors/add_colors.php');
									} else if(isset($_GET['remove'])){
										include ('operations/colors/remove_colors.php');
									} 
								}else if($_GET['input']=='job_kind'){
									if(isset($_GET['edit'])){
										include ('operations/job_kind/edit_kind.php');
									} else if(isset($_GET['add'])){
										include ('operations/job_kind/add_kind.php');
									} else if(isset($_GET['remove'])){
										include ('operations/job_kind/remove_kind.php');
									} 
								}else if($_GET['input']=='job_type'){
									if(isset($_GET['edit'])){
										include ('operations/job_type/edit_type.php');
									} else if(isset($_GET['add'])){
										include ('operations/job_type/add_type.php');
									} else if(isset($_GET['remove'])){
										include ('operations/job_type/remove_type.php');
									} 
								}else if($_GET['input']=='materials'){
									if(isset($_GET['edit'])){
										include ('operations/materials/edit_materials.php');
									} else if(isset($_GET['add'])){
										include ('operations/materials/add_materials.php');
									} else if(isset($_GET['remove'])){
										include ('operations/materials/remove_materials.php');
									} 
								}else if($_GET['input']=='paper_size'){
									if(isset($_GET['edit'])){
										include ('operations/paper_size/edit_paper_size.php');
									} else if(isset($_GET['add'])){
										include ('operations/paper_size/add_paper_size.php');
									} else if(isset($_GET['remove'])){
										include ('operations/paper_size/remove_paper_size.php');
									} 
								}else if($_GET['input']=='payments'){
									if(isset($_GET['edit'])){
										include ('operations/payments/edit_payments.php');
									} else if(isset($_GET['add'])){
										include ('operations/payments/add_payments.php');
									} else if(isset($_GET['remove'])){
										include ('operations/payments/remove_payments.php');
									} 
								}else if($_GET['input']=='printing'){
									if(isset($_GET['edit'])){
										include ('operations/printing/edit_printing.php');
									} else if(isset($_GET['add'])){
										include ('operations/printing/add_printing.php');
									} else if(isset($_GET['remove'])){
										include ('operations/printing/remove_printing.php');
									} 
								}else if($_GET['input']=='status'){
									if(isset($_GET['edit'])){
										include ('operations/status/edit_status.php');
									} else if(isset($_GET['add'])){
										include ('operations/status/add_status.php');
									} else if(isset($_GET['remove'])){
										include ('operations/status/remove_status.php');
									}
								}else if($_GET['input']=='units'){
									if(isset($_GET['edit'])){
										include ('operations/units/edit_units.php');
									} else if(isset($_GET['add'])){
										include ('operations/units/add_units.php');
									} else if(isset($_GET['remove'])){
										include ('operations/units/remove_units.php');
									} 
								}
							}?>
						</div><?php
					}?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>