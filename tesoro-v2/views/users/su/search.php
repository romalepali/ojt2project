<?php
	include ('config/su_verify.php');
	$_SESSION['page']='search.php';

	if(isset($_SESSION['search'])){
		$keywords = explode(" .-/:",$_SESSION['search']);
		$query="SELECT a.job_no,a.description,a.customer,a.pages,a.artist,a.cover,a.deadline_on,a.encoded_on,b.job_kind,c.firstname AS 'arf',c.lastname AS 'arl',d.firstname AS 'crf',d.lastname AS 'crl' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN users_list c ON a.artist=c.id LEFT JOIN users_list d ON a.cover=d.id WHERE";
		$keyCount = 0;
		foreach($keywords as $keys){
			if($keyCount > 0){
				$query .= " AND";
			}
			$query .= " a.job_no LIKE '%$keys%' OR a.customer LIKE '%$keys%' OR a.description LIKE '%$keys%'";
			++$keyCount;
		}
	}

	if(isset($_POST['search_submit'])){
		$_SESSION['search'] = $search = mysqli_real_escape_string($conn,$_POST['search']);
		$keywords = explode(" .-/:",$_SESSION['search']);
		$query="SELECT a.job_no,a.description,a.customer,a.pages,a.artist,a.cover,a.deadline_on,a.encoded_on,b.job_kind,c.firstname AS 'arf',c.lastname AS 'arl',d.firstname AS 'crf',d.lastname AS 'crl' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN users_list c ON a.artist=c.id LEFT JOIN users_list d ON a.cover=d.id WHERE";
		$keyCount = 0;
		foreach($keywords as $keys){
			if($keyCount > 0){
				$query .= " AND";
			}
			$query .= " a.job_no LIKE '%$keys%' OR a.customer LIKE '%$keys%' OR a.description LIKE '%$keys%'";
			++$keyCount;
		}
	}
	
	$count_query="SELECT count(*) AS 'ucount' FROM jo";
	$count_result=mysqli_query($conn,$count_query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
</head>

<style type="text/css">
	.index-z{
		z-index: 0;
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
						(isset($_GET['view']) || !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) && 
						(!isset($_GET['view']) || isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) &&
						(!isset($_GET['view']) || !isset($_GET['copies']) && isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) && (!isset($_GET['view']) || !isset($_GET['copies']) && !isset($_GET['status']) && isset($_GET['update_stat']) && !isset($_GET['add_copy'])) && 
						(!isset($_GET['view']) || !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && isset($_GET['add_copy']))
					) {?>
						<div style="margin-top: 50px;">
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
							</ul><?php
							include ('search/search_jo.php');?>
						</div><?php
					}else{?>
						<div style="margin-top: 50px;">
							<ul id="tabsJustified" class="nav nav-tabs">
								<li class="nav-item">
									<a href="search.php?search=jo" class="nav-link small text-uppercase"><?php
										if($_SESSION['search']!=NULL){?>
											Search Results for <strong>"<?php echo $_SESSION['search'];?>"</strong><?php
										}else{?>
											Search Results<?php
										}?>
									</a>
								</li>
							</ul><?php
							if(isset($_GET['view'])){
								include ('operations/job_orders/view_job_orders.php');
							} else if(isset($_GET['update_stat'])){
								include ('operations/job_orders/update_status.php');
							} else if(isset($_GET['status'])){
								include ('operations/job_orders/status_info.php');
							} else if(isset($_GET['copies'])){
								include ('operations/job_orders/copies_info.php');
							} else if(isset($_GET['add_copy'])){
								include ('operations/job_orders/add_copy.php');
							}?>
						</div><?php
					}?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/system/jo_search.js"></script>
</body>
</html>